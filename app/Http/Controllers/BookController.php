<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    # this is for dashboard
    public function book_library()
    {
        return view('admin.book_library');
    }
    
    public function index()
    {
        $books = Book::all();
        return view('admin.book_library', ['books' => $books]);
    }

    public function store(Request $request)
    {
        $callNumber = strtoupper(Str::random(8)); // Generates an 8-character random string

        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'subject' => 'required|string',
            'isbn' => 'required|string',
            'issn' => 'required|string',
            'available' => 'required|integer',
            'member_library' => 'required|integer',
        ]);

        Book::create([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'subject' => $request->input('subject'),
            'isbn' => $request->input('isbn'),
            'issn' => $request->input('issn'),
            'available' => $request->input('available'),
            'school' => $request->input('member_library'),
            'resource_type' => $request->input('resource_type'),
            'call_number' => $callNumber,
            'status' => 1
        ]);

        return response()->json(['success' => 'Book created successfully!']);
    }

    public function edit(Book $book)
    {
        return response()->json(['book' => $book]);
    }

    public function update(Request $request, Book $book)
    {
        try {
            $request->validate([
                'edit_title' => 'required|string',
                'edit_author' => 'required|string',
                'edit_subject' => 'required|string',
                'edit_isbn' => 'required|string',
                'edit_issn' => 'required|string',
                'edit_available' => 'required|integer',
                'edit_member_library' => 'required|integer',
            ]);

            $book->update([
                'title' => $request->input('edit_title'),
                'author' => $request->input('edit_author'),
                'subject' => $request->input('edit_subject'),
                'isbn' => $request->input('edit_isbn'),
                'issn' => $request->input('edit_issn'),
                'available' => $request->input('edit_available'),
                'school' => $request->input('edit_member_library'),
                'resource_type' => $request->input('edit_resource_type'),
                'status' => $request->input('edit_status')
            ]);

            return response()->json(['success' => 'Book updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating book.']);
        }
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(['success' => 'Book deleted successfully!']);
    }


}
