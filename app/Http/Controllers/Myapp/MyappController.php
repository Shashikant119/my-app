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
        //model
        $menu = new \App\Models\Navbar;
        $menus = $menu->treemenu();
        DD($menus);

        return view('My-App.index', compact('menus'));
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
        $input = $request->all();
        Clanguage::create($input);
        toastr()->success('Data has been saved successfully!');
        return redirect('/multi')->withInput();
    }

    //add language 
    public function addlanguage()
    {
        $datest[''] = '';
        $getdata = DB::table('codeslgs')->get();
        foreach ($getdata as $key => $value) {
           $st = $value->language;
        }
        $view_data['datest'] = $st;

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
        $d = $this->code;
        //DD($d);
        foreach ($d as $key => $value) {
           echo $key++.' '.$value;
           echo "<br>";
        }
    }

    public function learn3(Request $request)
    {
        
    }

    
}
