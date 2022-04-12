<?php

namespace App\Http\Controllers\Myapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\Navbar;
use App\Models\Clanguage;
use App\Models\Codeslg;
use Illuminate\Support\Facades\Session;

class MyappController extends Controller
{
    protected $records_per_page = 100;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myapp()
    {
       

        return view('My-App.index');
    }

    ///multiple language select
    public function multiplelanguage(Request $request)
    { 
        $view_data = []; 
        $data = Clanguage::all();

        $view_data['data'] = $data;
          
        /*foreach ($data as $key => $value) {
            
            $da = json_decode($value->cat);
             
            foreach($da as $value){
                print_r($value);
                echo "<br />";
            }
            echo $key."<br />";
        }*/

        // $view_data['datacat'] = $da;
        
        $lang = DB::table('codeslgs')->select('language')->get();
        $view_data['language'] = $lang;
        return view('multiplelg.index')->with($view_data);
    }

    public function multiplelanguagestore(Request $request)
    {
        if($request->get('cat') == null){
           toastr()->error('Select language Error!');
           return redirect('/multi'); 
        }
        $input = $request->all();
        Clanguage::create($input);
        toastr()->success('Data has been saved successfully!');
        return redirect('/multi');
    }

    //add language 
    public function addlanguage()
    {
        $datest[''] = '';
        $getdata = DB::table('codeslgs')->get();
        foreach ($getdata as $key => $value) {
           $st = json_decode($value->language);
        }
        $d = implode(' ',$st);
        $view_data['datest'] = $d;

        //DD($view_data);
        return view('multiplelg.addlg')->with($view_data);
    }


    public function savelanguage(Request $request)
    {
        $data = $request->all();

        
        $im = $request->get('language');

        $lang = explode(" ",$im);
        
        $pushdata = json_encode($lang);
        //DD($lang);
        $array = array(
          'language' => $pushdata
        );
        $getdata = DB::table('codeslgs')->select('language')->get();

        $view_data['language'] = $getdata;

        DB::table('codeslgs')->where('id', 1)->update($array);
         
        toastr()->success('Data has been saved successfully!');
        return redirect('/multi')->withInput();
    }

    //learn1 start here 

    public function index(Request $request)
    {

        $view_data = [];
        if(!$request->ajax()){
            return view('learn1.index')->with($view_data);
        }else{
            $data = Clanguage::all();
            $view_data['data'] = $data;
            $lang = DB::table('codeslgs')
            ->select('language')
            ->orderBy('id')
            ->get();
            $view_data['language'] = $lang;
            return view('learn1.list')->with($view_data);
        }
    }

    //learn2
    public function __construct(Request $request)
    {
        $this->data = DB::table('user_app')->get();
        $this->id = $request->id;
        $this->name = $request->name;
        $this->username = "John Jeny";
        $data = array('java', 'python', 'laravel', 'css', 'javascript', 'zend', 'wordpress', 'jquery', 'sql', 'progress', 'bootstrap');
        $this->code = $data;
    }

    public function learn2(Request $request)
    {
        //
        $view_data = [];
        if(!$request->ajax()){
           return view('learn2.index')->with($view_data); 
        }else{
        $country = DB::table('states')
        ->select('countries.name','states.country_id',DB::raw('count(*) as total'))
        ->groupBy('countries.name')
        ->groupBy('states.country_id')
        ->leftjoin('countries', 'countries.id', '=', 'states.country_id')
        ->get();
        $view_data['country'] = $country;
        //count 
        $totalc = DB::table('countries')->count('id');
        $totaltct = DB::table('cities')->count('id');
        $totals = DB::table('states')->count('id');
        $view_data['tc'] = $totalc;
        $view_data['ts'] = $totals;
        $view_data['tct'] = $totaltct;
        return view('learn2.list')->with($view_data);
       }   
    }

    public function getStates(Request $request)
    {
        $states = DB::table('states')
            ->leftjoin('cities', 'cities.state_id', '=', 'states.id')
            ->select('states.name','cities.state_id', DB::raw('count(*) as total'))
            ->groupBy('states.name')
            ->groupBy('cities.state_id')
            ->where('country_id', $request->country_id)
            ->get();
        
        if (count($states) > 0) {
            return response()->json($states);
        }else{
            return response()->json(['states' => 'No Data']);
        }
    }

    public function getCities(Request $request)
    {
        $cities = DB::table('cities')->select('name','state_id')
            ->where('state_id', $request->state_id)
            ->get();
        
        if (count($cities) > 0) {
            return response()->json($cities);
        }else{
            return response()->json(['states' => 'No Data']);
        }
    }

    public function learn3(Request $request)
    {
        return response()->json(['status' => 'okay', 'message' => 'successfully', 'error' => '']);
    }

}
