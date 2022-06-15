<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Chatbox;
use Illuminate\Support\Facades\Auth;
Use \Carbon\Carbon;

date_default_timezone_set('Asia/Kolkata');

class ChatboxController extends Controller
{
    //protected $user = Auth::user()->id;


    function __construct(Request $request)
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $view_data = [];
        if(!$request->ajax()){
            return view('chat.index')->with($view_data);
        }
        else{
            $query = DB::table('chatboxes')
            ->join('users', 'users.id', '=', 'chatboxes.user_id')
            ->where('chatboxes.C_deleted', '=', '1')
            ->where('chatboxes.status', '=', '1')
            ->get();

            $user = $query[0]->name;
            $view_data['user_name'] =  $user;

            $userprofile = $query[0]->profile;
            $view_data['user_profile'] =  $userprofile;

            $user_list = DB::table('users')->get();
            $view_data['user_list'] = $user_list;
            //DD($user);
            
            $view_data['message'] = $query;
            return view('chat.list')->with($view_data);
        }
    }
    public function sendsms(Request $request)
    {
        $date = Carbon::now();
        $data = array(
            'messages' => $request->get('sms'),
            'user_id' => Auth::id(),
            'C_deleted' => 1,
            'status' => 1,
            'ip_address' => $request->ip(),
            'created_at' => $date->format('Y-m-d H:i:s'),
            'updated_at' => $date->format('Y-m-d H:i:s')
        );
        DB::table('chatboxes')->insert($data);
        if (count($data) > 0) {
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['states' => 'No Data']);
        }
    }
}
