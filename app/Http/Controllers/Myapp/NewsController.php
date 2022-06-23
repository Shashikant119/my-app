<?php

namespace App\Http\Controllers\Myapp;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class NewsController extends Controller
{
    protected $records_per_page = 100;
    protected $disk_driver = 'my-app';


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $view_data = [];

        if (!$request->ajax()) {

            return view('news.index')->with($view_data);

        } else  {

            $request_data = $request->all();

            $page = $request_data['page'];
            $sort_by = $request_data['sort_by'];
            $sort_order = $request_data['sort_order'];

            $query = DB::table('news');
            
            if ($request->has('title') && !empty($request_data['title'])) {
                $query->where('title', 'like', '%' . trim($request_data['title']) . '%');
            }
            if (isset($request_data['status'])) {
                $query->where('status', $request_data['status']);
            }
            $records = $query->paginate($this->records_per_page);

            $record_starts = $this->records_per_page * ($page - 1) + 1;
            $record_ends = $this->records_per_page * ($page - 1) + count($records);

            $view_data['records'] = $records;
            $view_data['page'] = $page;
            $view_data['record_starts'] = $record_starts;
            $view_data['record_ends'] = $record_ends;

            return view('news.list')->with($view_data);
        }
    }

    public function create(Request $request)
    {
        $view_data = [];
        if (!empty($request->id)) {
          $view_data['record'] = DB::table('news')->where('id',$request->id)->first();
          return view('news.edit')->with($view_data);
        }
        return view('news.create')->with($view_data);
    }

    public function store(Request $request)
    {
       $status = 'failure';
        $message = 'Failure to save';
        $errors = [];
        try {
          $validator = Validator::make($request->all(), array(
             
              'file' => 'required|mimes:jpeg,png,jpg,webp,gif'
          ));

          if ($validator->fails()) {
            $status = 'failure';
            $message =  'Input Data Errors!!';
            $errors = $validator->errors();
          }else {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $imageName = 'as_'.time().'.'.$extension;
                $request->file('file')->move(public_path('news'), $imageName);
                $data = [
                  'title' => strtolower($request->title),
                  'path' => $imageName,
                  'status' => 1,
                  'created_at' => now(),
                  'updated_at' => now()
                ];
                DB::table('news')->insert($data);
                $status = 'OK';
                $message = 'uploaded Successfully!';
              }
          }
        } catch (\Exception $e) {
          $message = $e->getMessage();
        }finally{
          return response()->json([
            'status' => $status,
            'message' => $message,
            'errors' => $errors,
            'data' => []
          ]);
        }

    }

    public function update(Request $request)
    {
        
        $status = 'failure';
        $message = 'Failure to save';
        $errors = [];
        try {
          $validator = Validator::make($request->all(), array(
            
          ));

          if ($validator->fails()) {
            $status = 'ERROR';
            $message =  'Input Data Errors!!';
            $errors = $validator->errors();
          }

          $data['title'] = strtolower($request->title);
          $data['url'] = $request->url;
          $data['status'] = $request->status;

          if ($request->hasFile('file') && !empty($request->file('file'))) {
              $file = $request->file('file');
              $extension = $file->getClientOriginalExtension();
              $filename = 'as_'.time().'.'.$extension;
              $request->file('file')->move(public_path('news'), $filename);
              $news = DB::table('news')->where('id',$request->id)->first();
dd('hello'); exit();

              if (!empty($news->path)) {
                $exist_filename = trim($news->path);
                if(File::exists(public_path('news/'.$exist_filename))){
                    File::delete(public_path('news/'.$exist_filename));
                }
              }
              $data['path'] = $filename;
            }

            $data['updated_at'] = now();
            DB::table('news')->where('id',$request->id)->update($data);
            $status = 'OK';
            $message = 'uploaded Successfully!';


        } catch (\Exception $e) {
          $message = $e->getMessage();
        }finally{
          return response()->json([
            'status' => $status,
            'message' => $message,
            'errors' => $errors,
            'data' => []
          ]);
        }
    }

    public function destroy(Request $request)
    {
      $status = 'ERROR';
      $message = 'Failure to delete';
      $errors = [];
      try {
        if (!empty($request->id)) {
          $slider = DB::table('news')->where('id',$request->id)->first();
          if (!empty($slider->path)) {
            $exist_filename = trim($slider->path);
            $exist_filepath = $gcs_path.'/'.$exist_filename;
            if ($disk->exists($exist_filepath)) {
                $disk->delete($exist_filepath);
            }
          }
          DB::table('news')->where('id',$request->id)->delete();
          $status = 'OK';
          $message = 'Deleted Successfully!';
        }
      } catch (\Exception $e) {
        $message = $e->getMessage();
      }finally{
        return response()->json([
          'status' => $status,
          'message' => $message,
          'errors' => $errors,
          'data' => []
        ]);
      }
    }


}


