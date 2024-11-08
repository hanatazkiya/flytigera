<?php

namespace App\Http\Controllers;
use App\Models\Admins;
use App\Models\User;
use App\Models\Place;
use App\Models\Reservations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminsController extends Controller
{
    public $user_datas = [];

    function user_authenticate(){
        if(Auth::check()){
            $username = auth()->user()->username;
            if(User::where('username', $username)->first()) return true;
            else return false;
        } else return false;
    }

    function admin_authenticate_by_session(Request $request){
        if($request->session()->get('username')){
            $username = session('username');
            if(Admins::where('username', $username)->first()) return true;
            else return false;
        } else return false;
    }

    public function show_admin($username){
        $datas = Admins::where('username', $username)->first();
        if($datas) return view('show_admins', $datas);
        else return view('admin_not_found');
    }

    public function admin_login_page(Request $request){
        if($this->user_authenticate()) return back();
        else if($request->session()->get('username')) return back();  
        return view('admin');
    }

    function login_handler(Request $request){
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }; return back()->with('login_error_log', 'Username/Password Salah!');
    }

    public function admin_login(Request $request){
        if($this->user_authenticate()) return back();    
        else if($request->session()->get('username')) return back();  
        $dataset = $request->post();
        $res = Admins::where("username", $dataset['username'])->first();
        
        // note : add password verification logic
        if($res){  
            if(password_verify($dataset['password'], $res['password'])){
                session()->put('name', $res['name']);
                session()->put('username', $res['username']);
                session()->put('id', $res['id']);
                $request->session()->regenerate();
                config(['session.lifetime' => 18018010]);
                return redirect('/admin/places');
            } else return back()->with('login_error_log', 'Password Salah');
        } else return back()->with('login_error_log', 'Username Tidak Tersedia');
    }

    function check(Request $request){
        if($request->session()->get('username')) return "ada";
        else return "gak ada";
    }

    function place_page_by_admin(){
        if(!session()->get('id')) return redirect('/admin/login');
        $datas = Place::with('admin')->where('admin_id', session()->get('id'))->get();
        $user_data = $this->user_datas;
        return view('admin_place', compact('datas'), compact('user_data'));
    }

    function admin_create_place_page(){
        return view('create_place_page');
    }

    function post_place(Request $request){
        $datas = $request->post();
        $validate_data = Validator::make($request->all(), [
            "header_image" => 'image|file|max:2048',
            "name" => 'required',
            "description" => 'required',
            "short_description" => 'required',
            "price" => 'required',
            "slug" => 'required',
            "embedded_maps" => 'required|regex:/<iframe/|string|min:10'
        ]);

        if($validate_data->fails()) {
            return redirect()->back()->withErrors($validate_data)->withInput($datas);
        } else {
            $image_file = "/" .  $request->file('header_image')->store('place-images');
            $new_place_data = [
                "admin_id" => session('id'),
                "header_image" => $image_file,
                "name" => $datas['name'],
                "description" => $datas['description'],
                "short_description" => $datas['short_description'],
                "price" => $datas['price'],
                "slug" => $datas['slug'],
                "embedded_maps" => $datas['embedded_maps']
            ]; Place::create($new_place_data); return redirect('/admin/places');
        }
    }

    function admin_edit_place(Request $request){
        $datas = $request->post();
        $place_id = $datas['place_id'];
        $user_id = session()->get('id');
        $place_datas = Place::with('admin')->where('admin_id', $user_id)->get();
        $data_selected = $place_datas->find($place_id);

        if($data_selected){
            return view('edit_place_page', $data_selected);
        } 
        
        else{
            return "Invalid Post, Try To Hack Detected!";
        }
    }

    function format_datetime($datetime){
        $indonesian_days = array(
            "Sunday" => "Minggu",
            "Monday" => "Senin",
            "Tuesday" => "Selasa",
            "Wednesday" => "Rabu",
            "Thursday" => "Kamis",
            "Friday" => "Jumat",
            "Saturday" => "Sabtu"
        ); $date = substr($datetime, 0, 10);
        $day_time = date("d", strtotime($date));

        $indonesian_month = array(
            "January" => "Januari",
            "February" => "Februari",
            "March" => "Maret",
            "April" => "April",
            "May" => "Mei",
            "June" => "Juni",
            "July" => "Juli",
            "August" => "Agustus",
            "September" => "September",
            "October" => "Oktober",
            "November" => "November",
            "December" => "Desember"
        ); $day = $indonesian_days[date("l", strtotime($date))];
        $month = $indonesian_month[date("F", strtotime($date))];
        $year = date("Y", strtotime($date)); return "$day, $day_time $month $year";
    }

    function admin_edit_place_post (Request $request){
        $datas = $request->post();
        $validate_data = Validator::make($request->all(), [
            "header_image" => '',
            "name" => 'required',
            "description" => 'required',
            "short_description" => 'required',
            "price" => 'required',
            "slug" => 'required',
            "embedded_maps" => 'required|regex:/<iframe/|string|min:10'
        ]); if($validate_data->fails()) return redirect()->back()->withErrors($validate_data)->withInput($datas);

        
        $data_selected = Place::find($datas['place_id']);
        $dump = $data_selected->header_image;
        $data_selected->name = $datas['name'];
        $data_selected->description = $datas['description'];
        $data_selected->short_description = $datas['short_description'];
        $data_selected->price = $datas['price'];
        $data_selected->slug = $datas['slug'];
        $data_selected->embedded_maps = $datas['embedded_maps'];

        if($request->file('header_image')){
            $image_file = "/" .  $request->file('header_image')->store('place-images');
            $data_selected->header_image = $image_file; $data_selected->update(); Storage::delete($dump);
        } else $data_selected->update();

        return redirect('/admin/places');
    }

    function admin_logout(Request $request){
        if($this->user_authenticate()) return back();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Auth::logout(); session()->flush();
        return redirect('/admin');
    }

    function redirect_to_login_page(){
        return redirect('/admin');
    }

    function ticket_check(){
        $datas = Reservations::with(['place', 'user'])->get();
        $user_target = ["user_target" => "Semua"];

        $datas = Reservations::with(['place', 'user'])->whereHas('place', function($query){
            $query->where('admin_id', session()->get('id'));
        })->get();

        return view('check_ticket', compact('datas'), $user_target);
    }

    function post_ticket_data(Request $request){
        $datas = $request->post(); $find_for = $datas['find-for'];
        $user_data = User::where('name', "LIKE" , "%$find_for%")->get('id');
        $user_target = ['user_target' => ucfirst($find_for)];

        // reminder : hindari user data null
        if(count($user_data) == 0){
            $datas = collect([]);
            return view('check_ticket', compact('datas'), $user_target);
        }

        $dataset = Reservations::with(['place', 'user'])->where('user_id', $user_data[0])->get();
        foreach($user_data as $id_collection){
            $new_data = Reservations::with(['place', 'user'])->where('user_id', $id_collection['id'])->whereHas('place', function($query){
                $query->where('admin_id', session()->get('id'));
            })->get(); $dataset = $dataset->merge($new_data);
        }; $datas = $dataset; 

        foreach($datas as $booking_for) $booking_for['booking_for'] = $this->format_datetime($booking_for['booking_for']);
        // foreach($datas as $updated_at) $updated_at['updated_at'] = $this->format_datetime($updated_at['updated_at']); 

        return view('check_ticket', compact('datas'), $user_target);
    }

    function get_ticket_data(){
        return redirect('/admin/ticket');
    }
}
