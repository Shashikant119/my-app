<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
Use Illuminate\Support\Facades\DB;
use Auth;
use Validator;
use App\Models\User;
use Illuminate\Support\Str;

date_default_timezone_set("Asia/Kolkata");

class UsersController extends Controller
{
    protected $pg = 20;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(Request $request)
    {
       //$this->middleware('auth');
    }
    
    public function userlist()
    {
        $User = User::get()->toJson(JSON_PRETTY_PRINT);
        return response($User, 200);
    }

    public function registeruser(Request $request)
    {

        $fields=$request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed' 
        ]);

        //return $fields;
        $user=User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password'])
        ]);

        $token=$user->createToken('myapptoken')->plainTextToken;

        $response=[
            'user'=>$user,
            'token'=>$token
        ];
        return response([
            'status' => 'okay',
            'message' => 'successfully',
            'data' => $response
        ]);
    }

    public function products()
    {
        $products = DB::table('products')->get()->toJson(JSON_PRETTY_PRINT);
        return response($products, 200);
    }

    public function chats(Request $request)
    {
        $request_data = $request->all();
        $user = auth()->user();

        $chats = DB::table('chatboxes')->select('id', 'messages', 'status', 'created_at')
        ->simplePaginate($this->pg);
        if(!is_null($chats)){
            if(!is_null($user)){
              return response()->json([
                'status' => 'Okay',
                'message' => 'Record Found',
                'page' => $chats->currentPage(),
                'count' => $chats->count('id'),
                'user' => $user->id,
                'chats' => $chats->items()
              ]); 
            }
            else{
              return response()->json([
                'status' => 'Okay',
                'message' => 'Record Found',
                'page' => $chats->currentPage(),
                'count' => $chats->count('id'),
                'user' => 'user not login',
                'chats' => $chats->items()
              ]); 
            }
        }
        else{
            return response()->json([
               'status' => 'Error',
               'message' => 'Record Not Found',
               'data' => []
            ]);
        } 
    }
    //second api 
    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token];
        return response($response, 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    /*protected function respondWithToken($token)
    {
        $minutes = auth('api')->factory()->getTTL();
        $timestamp = now()->addMinute($minutes);
        $expires_at = date('M d, Y H:i A', strtotime($timestamp));
        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_at' => $expires_at
        ], 200);
    }*/

}
