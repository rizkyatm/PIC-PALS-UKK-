<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use App\Models\User;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function getAlbum($id)
    {   
        $user = User::find($id);
        $albums = Album::where('user_id', $id)->latest()->get();
        return view('user.album', compact('albums', 'user'));
    }

    public function create(Request $request)
    {
        // Buat album baru
        $album = new Album();
        $album->nama_album = $request->nama_album;
        $album->deskripsi = $request->deskripsi_album;
        // Set user_id sesuai dengan user yang sedang login
        $album->user_id = auth()->user()->id;
        $album->save();

        // Redirect ke halaman lain atau lakukan tindakan lainnya
        return back()->with('success', 'Album berhasil ditambahkan.');
    }

    public function getFoto($id)
    {   
        $album = Album::find($id);
        $fotos = Foto::where('album_id', $id)->latest()->get();
        return view('user.fotoAlbum', compact('fotos','album'));
    }
}
