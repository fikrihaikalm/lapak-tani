<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::with('user')->latest()->paginate(10);
        return view('admin.education.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.education.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('educations', 'public');
        }

        Education::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Konten edukasi berhasil ditambahkan!',
            'redirect' => route('admin.education.index')
        ]);
    }

    public function edit($id)
    {
        $education = Education::findOrFail($id);
        return view('admin.education.edit', compact('education'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $education = Education::findOrFail($id);
        $education->update([
            'title' => $request->title,
            'image_path' => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Konten edukasi berhasil diperbarui!',
            'redirect' => route('admin.education.index')
        ]);
    }

    public function destroy($id)
    {
        $education = Education::findOrFail($id);
        $education->delete();

        return response()->json([
            'success' => true,
            'message' => 'Konten edukasi berhasil dihapus!'
        ]);
    }
}