<?php

namespace App\Http\Controllers;
use App\Models\Admins;
use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    function user_authenticate(){
        if(Auth::check()){
            $username = auth()->user()->username;
            if(User::where('username', $username)->first()) return true;
            else return false;
        } else return false;
    }

    function admin_authenticate(){
        if(Auth::check()){
            $username = auth()->user()->username;
            if(Admins::where('username', $username)->first()) return true;
            else return false;
        } else return false;
    }

    function admin_place_edit($id){
        $datas = Place::with('admin')->find($id);
        $name = $datas['name'];
        return "anda mengedit $name";
    }

    function redirect_to_place(){
        if(!$this->user_authenticate()) return redirect('/login');
        return redirect('/places');
    }

    function place_page(){
        if(!$this->user_authenticate()) return redirect('/login');
        $datas = Place::with('admin')->get();
        return view('places', compact('datas'));
    }

    function select_place($slug){
        if(!$this->user_authenticate()) return redirect('/login');
        $place_data = Place::with('admin')->where('slug', $slug)->first();
        
        
        if(!stripos("</p>", $place_data['description']) || !stripos("</a>", $place_data['description'])){
            $desc = explode(". ", $place_data['description']); $counter = 0;
            
            foreach($desc as $words){
                $res[] = $words;
                if($counter%3 == 0) $res[] = ".<br> <br>";
                $counter++;
            } $desc = "";

            for($count=0; $count<count($res); $count++){
                $desc .= $res[$count] . "";
            } $place_data['description'] = $desc;
        }

        if($place_data != null) return view('selected_place', $place_data);
        else return redirect('/places');
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

    function search_place(Request $request){
        if(!$this->user_authenticate()) return redirect('/login');
        $looking_for = $request->post()['place-search'];
        $name = Place::with('admin')->where('name', 'LIKE' , "%$looking_for%")->get();
        $description = Place::with('admin')->where('description', 'LIKE' , "%$looking_for%")->get();
        $short_description = Place::with('admin')->where('short_description', 'LIKE' , "%$looking_for%")->get();
        $admin = Admins::where('name', 'LIKE' , "%$looking_for%")->get('id')->first();
        $admin = Place::where('admin_id', $admin)->get();
        $datas = $name->merge($description)->merge($short_description)->merge($admin);

        $split_data = explode(" ", $looking_for);
        foreach($split_data as $word){
            $name = Place::with('admin')->where('name', 'LIKE' , "%$word%")->get();
            $description = Place::with('admin')->where('description', 'LIKE' , "%$word%")->get();
            $short_description = Place::with('admin')->where('short_description', 'LIKE' , "%$word%")->get();
            $admin = Admins::where('name', 'LIKE' , "%$looking_for%")->get('id')->first();
            $admin = Place::where('admin_id', $admin)->get();
            $datas = $name->merge($description)->merge($short_description)->merge($admin);
        }; 


        if(count($datas) == 0){
            return view('places', compact('datas'));
        } else {
            return view('places', compact('datas'));
        }
    }

    function admin_search_place(Request $request){
        $looking_for = $request->post()['place-search'];
        $name = Place::with('admin')->where('name', 'LIKE' , "%$looking_for%")->get();
        $description = Place::with('admin')->where('description', 'LIKE' , "%$looking_for%")->get();
        $short_description = Place::with('admin')->where('short_description', 'LIKE' , "%$looking_for%")->get();
        $admin = Admins::where('name', 'LIKE' , "%$looking_for%")->get('id')->first();
        $admin = Place::where('admin_id', $admin)->get();
        $datas = $name->merge($description)->merge($short_description)->merge($admin);
        
        $split_data = explode(" ", $looking_for);
        foreach($split_data as $word){
            $name = Place::with('admin')->where('name', 'LIKE' , "%$word%")->get();
            $description = Place::with('admin')->where('description', 'LIKE' , "%$word%")->get();
            $short_description = Place::with('admin')->where('short_description', 'LIKE' , "%$word%")->get();
            $admin = Admins::where('name', 'LIKE' , "%$looking_for%")->get('id')->first();
            $admin = Place::where('admin_id', $admin)->get();
            $datas = $name->merge($description)->merge($short_description)->merge($admin);
        }; return view('admin_place', compact('datas'));
    }

    function preview_for_admin($slug){
        if($this->user_authenticate()) return redirect('/');
        $place_data = Place::with('admin')->where('slug', $slug)->first();
        
        
        if(!stripos("</p>", $place_data['description']) || !stripos("</a>", $place_data['description'])){
            $desc = explode(". ", $place_data['description']); $counter = 0;
            
            foreach($desc as $words){
                $res[] = $words;
                if($counter%3 == 0) $res[] = ".<br> <br>";
                $counter++;
            } $desc = "";

            for($count=0; $count<count($res); $count++){
                $desc .= $res[$count] . "";
            } $place_data['description'] = $desc;
        }

        if($place_data != null) return view('admin_preview', $place_data);
        else return redirect('/admin/places');
    }

    function delete_place(Request $request){
        $data = Place::find($request['id']);
        $data->delete(); return redirect('/admin/places');
    }
}
