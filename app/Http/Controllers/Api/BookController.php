<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return response()->json($books)->setStatusCode(200);
    }
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return response()->json(new BookResource($book))->setStatusCode(200);
    }
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'author_id' => 'required|integer|exists:authors,id',
                'description' => 'required|string|max:255',
                'photo' => 'required|image|mimes:jpeg,png,jpg,webm,webp|max:2048',
            ]);
            if($request->hasFile('photo')){
                $path = $request->file('photo')->store('photos', 'public');
                $validated['photo'] = $path;
            }
            $book = Book::create([... $validated, 'photo' => $path]);
            return response()->json($book)->setStatusCode(201);
        }
        catch (ValidationException $exception) {
            throw new ApiException(422, 'Validation failed', $exception->errors());
        }



    }
    public function update(Request $request, $id)
    {
        try {
            $book = Book::findOrFail($id);
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'author_id' => 'required|integer|exists:authors,id',
                'description' => 'required|string|max:255',
                'photo' => 'required|image|mimes:jpeg,png,jpg,webm,webp|max:2048',
            ]);
            if($request->hasFile('photo')){
                if($book->photo){
                    Storage::disk('public')->delete($book->photo);
                }
                $path = $request->file('photo')->store('photos', 'public');
                $validated['photo']->photo = $path;
            }
            $book->update($validated);
            return response()->json($book)->setStatusCode(201);
        }
        catch (ValidationException $exception) {
            throw new ApiException(422, 'Validation failed', $exception->errors());
        }
    }
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        if($book->photo){
            Storage::disk('public')->delete($book->photo);
        }
        $book->delete();
        return response()->json(null, 204);
    }
}
