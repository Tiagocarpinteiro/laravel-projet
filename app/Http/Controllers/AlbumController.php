<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{
    public function index() {
      return view('index');
    }

    public function about() {
      return 'About';
    }

    public function albums(){
      $albums = DB::select("SELECT * FROM albums");
      return view("albums", ['albums' => $albums]);
    }

    public function photos(){
      $albums = DB::select("SELECT * FROM albums");
      $photos = DB::select("SELECT * FROM photos");
      return view("photos", ['photos' => $photos]);
    }

    public function tags(){
      $tags = DB::select("SELECT * FROM tags");
      return view("tags", ['tags' => $tags]);
    }

    public function album($id){
        $album = DB::select("SELECT * FROM photos where album_id = ?", [$id]);
        return view("album", ['album' => $album]);
    }

}

