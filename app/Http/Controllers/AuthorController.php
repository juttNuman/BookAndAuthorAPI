<?php

namespace App\Http\Controllers;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
            $authors = Author::with('books')->get();
            return AuthorResource::collection($authors);
    }

    public function show($id)
    {
        $author = Author::with('books')->find($id);
        if (!$author) {
            return response()->json([
                'message' => 'Author not found',
            ], 404);
        }
        return new AuthorResource($author);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author = Author::create([
            'name' => $request->input('name'),
        ]);

        return new AuthorResource($author);
    }

    public function update(Request $request, $id)
    {
        $author = Author::find($id);
        if (!$author) {
            return response()->json([
                'message' => 'Author not found',
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author->update([
            'name' => $request->input('name'),
        ]);

        return new AuthorResource($author);
    }

    public function destroy($id)
    {
        $author = Author::find($id);
        if (!$author) {
            return response()->json([
                'message' => 'Author not found',
            ], 404);
        }

        $author->delete();

        return response()->json([
            'message' => 'Author deleted successfully',
        ], 200);
    }

    
}
