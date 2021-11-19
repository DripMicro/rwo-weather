<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\Longforecast;
use App\Models\Region;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{

    
    private $year;
    private $month;

    public function test(){
        $region = Region::All();
        echo json_encode($region);
    }

    public function index()
    {
        return view('auth.login');
    }  
      

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }



    public function registration()
    {
        return view('companies.registration');
    }
      

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

    public function dashboard()
    {
        if(Auth::check()){
        	$datas = Longforecast::where('year', $this->year)->where('month', $this->month)->get();
            $blogs = Image::orderBy('created_at', 'desc')->limit(20)->get();
            $region = Region::All();
            return view('main/dashboard')->withregion($region)->withdatas($datas)->withblogs($blogs)->withyear($this->year)->withmonth($this->month);
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function getData(Request $req)
    {
        $this->year = $req->year;
        $this->month = $req->month;
        if(Auth::check()){
            $datas = Longforecast::where('year', $this->year)->where('month', $this->month)->get();
            $region = Region::All();
            $blogs = Image::orderBy('created_at', 'desc')->limit(20)->get();
            return view('main/dashboard')->withregion($region)->withdatas($datas)->withblogs($blogs)->withyear($this->year)->withmonth($this->month);
        }
    }

    public function showData()
    {
        if(Auth::check()){
        	$datas = Region::All();
        	return view('main/createData')->withdatas($datas);
        }
        return redirect("login")->withSuccess('You are not allowed to access');	
    }
    
    public function createData(Request $request)
    {

        $region = Region::All();
        $isexist = Longforecast::where('year', $request->year)->where('month', $request->month)->get();
        if( $isexist->count() > 0 ){
            return redirect("admin/createData")->withSuccess('Data is already exist. you have to update'); 
        }

        for ($i=0; $i < count($region); $i++) { 
            $data = new Longforecast;
            $data->region = $request['data_'.$region[$i]->id.'_0'];
            $data->temp = $request['data_'.$region[$i]->id.'_1'];
            $data->humidity = $request['data_'.$region[$i]->id.'_2'];
            $data->rainfall = $request['data_'.$region[$i]->id.'_3'];
            $data->snowfall = $request['data_'.$region[$i]->id.'_4'];
            $data->daylight = $request['data_'.$region[$i]->id.'_5'];
            $data->sunshine = $request['data_'.$region[$i]->id.'_6'];
            $data->year = $request->year;
            $data->month = $request->month;
            $data->save();    
        }
        
        return redirect("admin/createData"); 
    }
   
    public function showUpdateData() {
        $datas = Longforecast::where('year', $this->year)->where('month', $this->month)->get();
        $region = Region::All();
        return view('main/updateData')->withregion($region)->withdatas($datas)->withyear($this->year)->withmonth($this->month);
    }
    public function getUpdateData(Request $req)
    {
        $this->year = $req->year;
        $this->month = $req->month;
        if(Auth::check()){
            $datas = Longforecast::where('year', $this->year)->where('month', $this->month)->get();
            $region = Region::All();
            return view('main/updateData')->withregion($region)->withdatas($datas)->withyear($this->year)->withmonth($this->month);
        }
    }
    public function updateData(Request $request)
    {

        $region = Region::All();
        for ($i=0; $i < count($region); $i++) { 
            $data = Longforecast::find($request['data_'.$region[$i]->id.'_0']);
            // $data->region = $request['data_'.$region[$i]->id.'_0'];
            $data->temp = $request['data_'.$region[$i]->id.'_1'];
            $data->humidity = $request['data_'.$region[$i]->id.'_2'];
            $data->rainfall = $request['data_'.$region[$i]->id.'_3'];
            $data->snowfall = $request['data_'.$region[$i]->id.'_4'];
            $data->daylight = $request['data_'.$region[$i]->id.'_5'];
            $data->sunshine = $request['data_'.$region[$i]->id.'_6'];
            $data->save();    
        }
        
        return redirect("admin/updateData"); 
    }
}