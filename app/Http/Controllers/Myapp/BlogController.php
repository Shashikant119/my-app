<?php

namespace App\Http\Controllers\Myapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $view_data = [];
        if(!$request->ajax()){
            return view('blog.index');
        }
        else{
         $query = DB::table('post')->get();
        //DD($query);
         return view('blog.index');   
        }
        
    }
    public function customer()
    {
        // $data = '';
        // $customer = DB::table('user_app')->get();
        // $data = $customer;
        // foreach($data as $key=> $customers)
        // {
        //     echo $customers->firstName; die();
        // } 

        // new query in sql

        //$email = DB::table('users')->where('id', '1')->value('email');
        //$user = DB::table('users')->select('id')->orderBy('id','ASC')->get();
        $email_or_name_or_updated_at = "ram";

        $result = User::where('name','LIKE','%'.$email_or_name_or_updated_at.'%')
                ->orWhere('email','LIKE','%'.$email_or_name_or_updated_at.'%')
                ->orWhere('updated_at','LIKE','%'.$email_or_name_or_updated_at.'%')
                ->get();

        DD($result);




        $cache_key = 'customer_data';
        if (Cache::has($cache_key)) {
          $user_app = Cache::get($cache_key);

        }else {
            $user  = DB::table('user_app')->get();
            $user_app = $user;
            try{
                  Cache::put($cache_key, $user, now()->addMinutes(5));
              }catch(\Exception $e){}
        }
        return view('My-App.customer',compact('user_app'));
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerbloguser(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required',
            'mobile' => 'required|max:10',
            'email' => 'required|email|unique:user_app',
            'passwordHash' => 'required',
        ]);
        $ext = $request['profile']->extension();
        $image = time().'.'.$ext;
        $path = public_path('profile');
        $imagepath = $request->profile->move($path, $image);
        $data = array(
            'firstName' =>$request->get('firstName'),
            'middleName' =>$request->get('middleName'),
            'lastName' =>$request->get('lastName'),
            'mobile' =>$request->get('mobile'),
            'email' =>$request->get('email'),
            'passwordHash' =>$request->get('passwordHash'),
            'registeredAt' => date("Y-m-d h:i:s"),
            'lastLogin' => null,
            'intro' =>$request->get('intro'),
            'profile' => $imagepath
        );
        DB::table('user_app')->insert($data);
        toastr()->success('Data has been saved successfully!');
        return redirect('/customer')->withInput();
        // /toastr()->success('Data has been saved successfully!');
    }

    public function status(Request $request)
    {
      $status = 'failure';
      $message = 'Failure to update status';
      DB::beginTransaction();
      try {
        if (!empty($request->id)) {
          DB::table('user_app')->where('id',$request->id)->update([
            'status' => $request->status
          ]);
          DB::commit();
          $status = 'success';
          $message = 'Record status updated successfully!';
        }
      } catch (\Exception $e) {
        $message = $e->getMessage();
        DB::rollback();
      }finally{
        return response()->json([
          'status' => $status,
          'message' => $message,
          'errors' => []
        ]);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
