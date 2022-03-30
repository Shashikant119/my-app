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
    protected $records_per_page = 10;
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

    //menu list with ajax
    public function menulist(Request $request)
    {
        $view_data = [];

        if (!$request->ajax()) {

        return view('users.menu')->with($view_data);

        } else {
        $page = $request->page;
        $sort_by = $request->sort_by;
        $sort_order = $request->sort_order;

        $query = DB::table('menus');
        $query->selectRaw('*');
        $query->where('parent_id','=','0');

        $query->orderBy($sort_by, $sort_order);

        $records = $query->paginate($this->records_per_page);

        $record_starts = $this->records_per_page * ($page - 1) + 1;
        $record_ends = $this->records_per_page * ($page - 1) + count($records);

        $multiple = DB::table('menus')->get();
        $view_data['multiplem'] = $multiple;

        $view_data['records'] = $records;
        $view_data['page'] = $page;
        $view_data['record_starts'] = $record_starts;
        $view_data['record_ends'] = $record_ends;
       
        return view('users.menu_list')->with($view_data);
        }
    }
}
