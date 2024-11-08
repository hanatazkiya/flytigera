<?php

namespace App\Http\Controllers;
use App\Models\Admins;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Place;
use App\Models\Reservations;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    function user_authenticate(){
        if(Auth::check()){
            $username = auth()->user()->username;
            if(User::where('username', $username)->first()) return true;
            else return false;
        } else return false;
    }

    function admin_authenticate_by_session(){
        if(session('username')){
            $username = session('username');
            if(Admins::where('username', $username)->first()) return true;
            else return false;
        } else return false;
    }

    function redirect_to_register_page(){
        return redirect('/register');
    }

    function register_page(){
        return view('register');    
    }

    function register_handler(Request $request){
        $data = $request->post();
        $dataset = [
            "name" => $data['name'],
            "email" => $data['email'],
            "username" => $data['username'],
            "password" => bcrypt($data['password']),
            "remember_token" => $data['_token']
        ]; 
        
        $username = $dataset['username'];
        $user_taken = User::where('username', $username)->first();
        if($user_taken == null) $user_taken = Admins::where('username', $username)->first();
        
        if($user_taken == null) User::create($dataset);
        else return back()->with('warning_message',"Akun sudah tersedia, harap ganti username anda");
        return redirect('/login');
    }

    function show_profile_by_username($username){
        $user_data = User::where('username', $username)->first();
        if($user_data != null) return view('show_profile', $user_data);
        else return "maaf, user dengan username  $username tidak tersdia";
    }

    function login_page(){
        return view('login');
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

    function dashboard_page(){
        return view('dashboard');
    }

    function user_logout(Request $request){
        Auth::logout(); //--> logout method
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    function is_user_not_admin($username){
        $res = Admins::where('username', $username)->first();
        if($res) return false;
        else return true;
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


    function history_page(){
        if(Auth::check()){
            $username = auth()->user()->username;
            if($this->is_user_not_admin($username)){
                $datas = Reservations::with('place')->where('user_id', auth()->user()->id)->get();
                foreach($datas as $history_data) $history_data['booking_for'] = $this->format_datetime($history_data['booking_for']);
                return view('history', compact('datas'));
            } else return redirect('/admin');
        } else return redirect('/login');
    }

    function cancel_booking(Request $request){
        if(!$this->user_authenticate()) return redirect('/login');
        $reservations_id = $request->post()['reservations-id'];
        $reservations = Reservations::find($reservations_id);
        $reservations->delete(); return redirect('/history');
    }

    function change_booking(Request $request){
        if(!$this->user_authenticate()) return redirect('/login');
        $datas = $request->post()['reservation-id']; 
        $datas = Reservations::with('place')->find($datas);
        $datas['booking_for'] = $this->format_datetime($datas['booking_for']);
        return view('change_booking', compact('datas'));
    }

    function update_booking_date(Request $request){
        if(!$this->user_authenticate()) return redirect('/login');
        $datas = $request->post();
        $reservation_data = Reservations::find($datas['reservation-id']);
        $reservation_data->booking_for = $datas['datetime-update'];
        $reservation_data->update(); return redirect('/history');
    }

    function get_recommendation(){
        if(!$this->user_authenticate()) return redirect('/login');
        $datas = Place::with('admin')->get()->take(20);
        return view('recommendation', compact('datas'));
    }
}
