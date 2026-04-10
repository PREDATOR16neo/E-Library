<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genres;
use App\Models\Authors;
use App\Models\Books;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    function index()
    {
        $books = Books::with(['genre', 'author'])->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $genres  = Genres::all();
        $authors = Authors::all();
        return view('books.create', compact('genres', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'        => 'required|max:255',
            'sinopsis'     => 'required|max:255',
            'tahun_terbit' => 'required|integer',
            'image'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'genre_id'     => 'required',
            'author_id'    => 'required'
        ]);

        $imagePath = $request->file('image')->store('Books', 'public');

        Books::create([
            'judul'        => $request->judul,
            'sinopsis'     => $request->sinopsis,
            'tahun_terbit' => $request->tahun_terbit,
            'image'        => $imagePath,
            'genre_id'     => $request->genre_id,
            'author_id'    => $request->author_id
        ]);

        return redirect()->route('books.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function detail($id)
    {
        $detail = Books::with(['genre', 'author'])->findOrFail($id);
        return view('books.detail', compact('detail'));
    }

    public function destroy($id)
    {
        $delete = Books::findOrFail($id);

        if ($delete->image && Storage::disk('public')->exists($delete->image)) {
            Storage::disk('public')->delete($delete->image);
        }

        $delete->delete();
        return redirect()->route('books.index')->with('success', 'Data berhasil dihapus');
    }

    public function edit($id)
    {
        $books   = Books::findOrFail($id);
        $genres  = Genres::all();
        $authors = Authors::all();
        return view('books.edit', compact('books', 'genres', 'authors'));
    }

    public function update(Request $request, $id)
    {
        $books = Books::findOrFail($id);

        // ── Validasi ──
        $request->validate([
            'judul'        => 'required|max:255',
            'sinopsis'     => 'required',
            'tahun_terbit' => 'required|integer',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'genre_id'     => 'required',
            'author_id'    => 'required'
        ]);

        // ── Handle image ──
        $imagePath = $books->image; // default: pakai gambar lama

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($books->image && Storage::disk('public')->exists($books->image)) {
                Storage::disk('public')->delete($books->image);
            }
            // Simpan gambar baru
            $imagePath = $request->file('image')->store('Books', 'public');
        }

        // ── Update data ──
        $books->update([
            'judul'        => $request->judul,
            'sinopsis'     => $request->sinopsis,
            'tahun_terbit' => $request->tahun_terbit,
            'image'        => $imagePath,
            'genre_id'     => $request->genre_id,
            'author_id'    => $request->author_id,
        ]);

        return redirect()->route('books.index')->with('success', 'Data berhasil diupdate');
    }
}
