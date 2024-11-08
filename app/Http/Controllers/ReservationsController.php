<?php

namespace App\Http\Controllers;

use App\Models\Reservations;
use Illuminate\Http\Request;
use App\Models\Admins;
use Illuminate\Support\Facades\Auth;

class ReservationsController extends Controller
{
    function is_user_not_admin($username){
        $res = Admins::where('username', $username)->first();
        if($res) return false;
        else return true;
    }

    function place_reservation(Request $request){
        if(Auth::check()){
            $username = auth()->user()->username;
            if($this->is_user_not_admin($username)){
                $place_data = $request->post();
                $total = floatval($place_data['booking_total']) * floatval($place_data['price']);
                $user_id = auth()->user()->id;
                $place_data_postable = [
                    "user_id" => $user_id,
                    "place_id" => $place_data['place_id'],
                    "booking_for" => $place_data['booking_for'],
                    "total" => $total
                ]; Reservations::create($place_data_postable);
                return redirect('/places');
            } else return redirect('/admin');
        } else return redirect('/login');
    }
}
