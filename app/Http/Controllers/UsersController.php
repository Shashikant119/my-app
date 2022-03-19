<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
Use Illuminate\Support\Facades\DB;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cache_key = 'user_data';
        if (Cache::has($cache_key)) {
          $users = Cache::get($cache_key);

        }else {
            $user  = User::all();
            $users = $user;
            try{
                  Cache::put($cache_key, $user, now()->addMinutes(5));
              }catch(\Exception $e){}
        }
        return view('users.users-view',compact('users'));
    }

    /*$cache_key = 'user_data';
    if(Cache::has($cache_key)){
        $users = Cache::get($cache_key);
    }else{
        $user = User::all();
        $suers = $user;
        try{
            Cache::put($cache_key, $users, now()->addMinutes(5));
        }catch(\Exception $e){}
    }
    return view('users.index', compact('users'));*/

    public function countuser($value='')
    {
        $count = 0;
        $countuser = DB::table('users')->get();
        DD($countuser);
        foreach ($countuser as $index => $value) {
            echo $count+=$value->id;
        }
        //DD($countuser);
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
    public function store(Request $request)
    {
        //
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
