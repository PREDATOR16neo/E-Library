<?php

namespace App\Http\Controllers;

use App\Models\Genres;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $genres = Genres::all();
        $no = 1;
        return view('genres.index', compact('genres','no'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('genres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $genres = $request->validate([
            "name_genres"=>"required|max:255"
        ]);

        if (!$genres){
            return redirect()->route("genre.index");
        }

        Genres::create($genres);
        return redirect()->route("genre.index")->with('success', 'berhasil menambah genre');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genres $genres)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit = Genres::find($id);
         return view("genres.edit", compact('edit') );
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        

        $genres = Genres::find($id);

        $genres->update($request->all());

        return redirect()->route("genre.index")->with("success", 'berhasil update genre');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        //
        $hapus = Genres::find($id)->delete();

        return redirect()->route('genre.index')->with('success' , 'berhasil hapus genre');
    }
}