<?php

namespace App\Http\Controllers\Myapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;


class PostController extends Controller
{
    protected $records_per_page = 50;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      
    }

    public function index(Request $request)
    {
     $view_data = [];

      if (!$request->ajax()) {

          return view('catpost.index')->with($view_data);

      } else  {

          $request_data = $request->all();

          $page = $request_data['page'];
          $sort_by = $request_data['sort_by'];
          $sort_order = $request_data['sort_order'];

          $query = DB::table('cate__posts AS pc');
          $query->where('pc.is_active', 1);

          if ($request->has('name') && !empty($request_data['name'])) {
              $query->where('name', 'like', '%' . trim($request_data['name']) . '%');
          }
          $query->selectRaw("pc.*");
          $concerns = $query->paginate($this->records_per_page);
         
          $record_starts = $this->records_per_page * ($page - 1) + 1;
          $record_ends = $this->records_per_page * ($page - 1) + count($concerns);

          $view_data['concerns'] = $concerns;
          $view_data['page'] = $page;
          $view_data['record_starts'] = $record_starts;
          $view_data['record_ends'] = $record_ends;

          return view('catpost.list')->with($view_data);
      }
    }

    public function create(Request $request)
    {
        $view_data = [];
        if (!empty($request->id)) {
          $view_data['concern'] = DB::table('cate__posts')->where('id',$request->id)->first();
        }
        return view('catpost.create')->with($view_data);
    }

    public function store(Request $request)
    {
     $status = 'failure';
      $message = 'Failure to save';
      $errors = [];
      DB::beginTransaction();
      try {
        $validator = Validator::make($request->all(), array(
            'name' => 'required'
        ));
        if ($validator->fails()) {
          $message = 'Input Data Errors!!';
          $errors = $validator->errors();
        }
        if (!empty($request->id)) {
          $data = DB::table('cate__posts')->where('id',$request->id)->update([
            'name' => strtolower($request->name),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'description' => $request->description,
            'meta_keyword' => $request->meta_keyword,
            'h1tag' => $request->h1tag,
            'is_active' => 1
          ]);
          $message = 'Product Post updated successfully!';
        }else {
          $data = DB::table('cate__posts')->where('name',strtolower($request->name))->first();
          if (!empty($data)) {
            $message = 'Product Post already Exists!';
          }else {
            DB::table('cate__posts')->insert([
              'name' => strtolower($request->name),
              'meta_title' => $request->meta_title,
              'meta_description' => $request->meta_description,
              'description' => $request->description,
              'meta_keyword' => $request->meta_keyword,
              'h1tag' => $request->h1tag,
              'created_at' => now(),
              'is_active' => 1,
              'updated_at' => now()
            ]);
            $message = 'Product Post save successfully!';
          }
        }
        DB::commit();
        $status = 'success';
      } catch (\Exception $e) {
        $message = $e->getMessage();
        DB::rollback();
      }finally{
        return response()->json([
          'status' => $status,
          'message' => $message,
          'data' => [],
          'errors' => $errors
        ]);
      }

    }

    public function delete(Request $request)
    {
      if (!empty($request->id)) {
        $data = DB::table('cate__posts')->where('id', $request->id)->delete();
        return response()->json([
          'status' => 'success',
          'message' => 'Product post deleted successfully',
          'data' => []
        ]);
      }
      return response()->json([
        'status' => 'failure',
        'message' => 'Input Data Errors!!',
        'data' => []
      ]);
    }


    //use this next controller
    
}
