<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Runner\Baseline\Reader;

class AlbumController extends Controller
{
    public function index() {
      return view('index');
    }

    public function albums(Request $request){
        $searchDate = $request->input('search_date');
        $searchTitle = $request->input('search_title');

        $query = "SELECT * FROM albums";
        $variables = [];

        if ($searchTitle) {
            $query .= " WHERE titre LIKE ?";
            $variables[] = "%$searchTitle%";
        }

        if ($searchDate){
            if ($searchDate == "ASC"){
                $query .= " ORDER BY creation ASC";

            }else{
                $query .= " ORDER BY creation DESC";

            }
        }
        $albums = DB::select($query, $variables);
        return view("albums", ['albums' => $albums]);
    }
    public function tags(){
      $tags = DB::select("SELECT * FROM tags");
      return view("tags", ['tags' => $tags]);
    }

    public function album(Request $request,$id){
        $album = DB::select("SELECT * FROM albums where id = ?", [$id]);

        $tagId = $request->input('tag_id');
        $searchTitle = $request->input('search_title');

        $query = "SELECT photos.id,  photos.url, photos.titre, photos.note, photos.album_id FROM photos";
        $variables = [];

        if ($tagId) {
            $query .= " JOIN possede_tag ON possede_tag.photo_id = photos.id WHERE possede_tag.tag_id = ?";
            $variables[] = $tagId;
        }

        if ($searchTitle) {
            $query .= ($tagId ? " AND" : " WHERE") . " titre LIKE ?";
            $variables[] = "%$searchTitle%";
        }

        if ($searchTitle OR $tagId){
            $query .= ' AND photos.album_id = ?';
            $variables[] = $id;
        }else{
            $query .= ' WHERE photos.album_id = ?';
            $variables[] = $id;
        }


        $photos = DB::select($query, $variables);

        foreach ($photos as $photo) {
            $id = $photo->id;
            $tags = DB::select("SELECT tags.nom, tags.id FROM photos JOIN possede_tag ON possede_tag.photo_id = photos.id JOIN tags ON tags.id = possede_tag.tag_id WHERE photos.id = ? ", [$id]);
            $photo->tags = $tags;
        }

        $tags = DB::select("SELECT * FROM tags");
        return view("album", ['album' => $album[0], 'photos' => $photos, 'tags' => $tags]);
    }

    public function edit_album($id){
        $photos = DB::select("SELECT * FROM photos where album_id = ?", [$id]);
        $album = DB::select("SELECT * FROM albums where id = ?", [$id]);
        return view("edit_album", ['album' => $album[0], 'photos' => $photos]);
    }

    public function addphoto($id){
      $album = DB::select("SELECT * FROM albums where id = ?", [$id]);
      $tags = DB::select("SELECT * FROM tags");
      return view("addphoto", ['album' => $album[0], 'tags' => $tags]);
    }

    public function addphotoT(Request $request){
        $titre = $request->input('title');
        $url = $request->input('url');
        $note = $request->input('note');
        $album_id = $request->input('album_id');
        if ($note > 5) {
            $note = 5;
        }

        if ($note < 1) {
            $note = 1;
        }
        $photoId = DB::table('photos')->insertGetId([
            'titre' => $titre,
            'url' => $url,
            'note' => $note,
            'album_id' => $album_id,
        ]);
        $selectedTags = $request->input('tag_ids');
        if (!empty($selectedTags)) {
            foreach ($selectedTags as $tagId) {
                DB::table('possede_tag')->insert([
                    'photo_id' => $photoId,
                    'tag_id' => $tagId,
                ]);
            }
        }
        return redirect('/album/'.$album_id);
    }


    public function deletephoto(int $album_id,int $photo_id){
      DB::table('photos')->where('id', $photo_id)->delete();
      DB::table('possede_tag')->where('photo_id', $photo_id)->delete();
      return redirect('/editalbum/'.$album_id);
  }

    public function photos(Request $request) {
        $tagId = $request->input('tag_id');
        $searchTitle = $request->input('search_title');

        $query = "SELECT photos.id,  photos.url, photos.titre, photos.note, photos.album_id FROM photos";
        $variables = [];

        if ($tagId) {
            $query .= " JOIN possede_tag ON possede_tag.photo_id = photos.id WHERE possede_tag.tag_id = ?";
            $variables[] = $tagId;
        }

        if ($searchTitle) {
            $query .= ($tagId ? " AND" : " WHERE") . " titre LIKE ?";
            $variables[] = "%$searchTitle%";
        }

        $photos = DB::select($query, $variables);

        foreach ($photos as $photo) {
            $id = $photo->id;
            $tags = DB::select("SELECT tags.nom, tags.id FROM photos JOIN possede_tag ON possede_tag.photo_id = photos.id JOIN tags ON tags.id = possede_tag.tag_id WHERE photos.id = ? ", [$id]);
            $photo->tags = $tags;
        }

        $tags = DB::select("SELECT * FROM tags");
        return view("photos", ['photos' => $photos, 'tags' => $tags]);
    }

}

