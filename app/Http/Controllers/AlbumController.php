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
      $photos = DB::select("SELECT * FROM photos");
        foreach ($photos as $photo) {
            $id = $photo->id;
            $tags = DB::select("SELECT tags.nom, tags.id FROM photos JOIN possede_tag ON possede_tag.photo_id = photos.id JOIN tags ON tags.id = possede_tag.tag_id WHERE photos.id = ? ", [$id]);
            $photo->tags = $tags;
        }
      $tags = DB::select("SELECT * FROM tags");
      return view("photos", ['photos' => $photos]);
    }

    public function tags(){
      $tags = DB::select("SELECT * FROM tags");
      return view("tags", ['tags' => $tags]);
    }

    public function album($id){
        $photos = DB::select("SELECT * FROM photos where album_id = ? ", [$id]);
        $album = DB::select("SELECT * FROM albums where id = ?", [$id]);
        foreach ($photos as $photo) {
            $id = $photo->id;
            $tags = DB::select("SELECT tags.nom, tags.id FROM photos JOIN possede_tag ON possede_tag.photo_id = photos.id JOIN tags ON tags.id = possede_tag.tag_id WHERE photos.id = ? ", [$id]);
            $photo->tags = $tags;
        }
        return view("album", ['album' => $album[0], 'photos' => $photos]);
    }

    public function edit_album($id){
        $photos = DB::select("SELECT * FROM photos where album_id = ?", [$id]);
        $album = DB::select("SELECT * FROM albums where id = ?", [$id]);
        return view("edit_album", ['album' => $album[0], 'photos' => $photos]);
    }

    public function addphoto($id){
      $album = DB::select("SELECT * FROM albums where id = ?", [$id]);
      return view("addphoto", ['album' => $album[0]]);
    }
    
    public function addphotoT(){
        $titre = $_POST['title'];
        $url = $_POST['url'];
        $note = $_POST['note'];
        $album_id = $_POST['album_id'];
        DB::insert('insert into photos (titre, url, note, album_id) values (?, ?, ?, ?)', [$titre, $url, $note, $album_id]);
        return redirect('/album/'.$album_id);
    }

    public function deletephoto(int $album_id,int $photo_id){
      DB::table('photos')->where('id', $photo_id)->delete();
      DB::table('possede_tag')->where('photo_id', $photo_id)->delete();
      return redirect('/editalbum/'.$album_id);
  }
    
}

