<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::where('user_id', auth()->id())->latest()->paginate(10);
        return view('petani.education.index', compact('educations'));
    }

    public function create()
    {
        return view('petani.education.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        Education::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'image_url' => $request->image_url,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Konten edukasi berhasil ditambahkan!',
            'redirect' => route('petani.education.index')
        ]);
    }

    public function edit($id)
    {
        $education = Education::where('user_id', auth()->id())->findOrFail($id);
        return view('petani.education.edit', compact('education'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        $education = Education::where('user_id', auth()->id())->findOrFail($id);
        $education->update([
            'title' => $request->title,
            'content' => $request->content,
            'image_url' => $request->image_url,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Konten edukasi berhasil diperbarui!',
            'redirect' => route('petani.education.index')
        ]);
    }

    public function destroy($id)
    {
        $education = Education::where('user_id', auth()->id())->findOrFail($id);
        $education->delete();

        return response()->json([
            'success' => true,
            'message' => 'Konten edukasi berhasil dihapus!'
        ]);
    }
}