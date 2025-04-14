<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with(['category', 'genres']);
        $currentUser = auth()?->user();

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('author', 'LIKE', "%{$searchTerm}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by genres
        if ($request->filled('genres')) {
            $query->whereHas('genres', function($q) use ($request) {
                $q->whereIn('genres.id', $request->genres);
            });
        }

        $books = $query->paginate(5)->withQueryString();
        $categories = Category::all();
        $genres = Genre::all();

        return view('librarian.books.index', compact('books', 'categories', 'genres', 'currentUser'));
    }

    public function userIndex(Request $request)
    {
        $query = Book::with(['category', 'genres']);
        $currentUser = auth()?->user();

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('author', 'LIKE', "%{$searchTerm}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by genres
        if ($request->filled('genres')) {
            $query->whereHas('genres', function($q) use ($request) {
                $q->whereIn('genres.id', $request->genres);
            });
        }

        $books = $query->paginate(5)->withQueryString();
        $categories = Category::all();
        $genres = Genre::all();

        return view('user.index', compact('books', 'categories', 'genres', 'currentUser'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'description' => 'required|string',
                'publisher' => 'required|string|max:255',
                'publication_date' => 'required|date',
                'category_id' => 'required|exists:categories,id',
                'total_copies' => 'required|integer|min:1',
                'genres' => 'required|array|exists:genres,id'
            ]);

            $imagePath = $request->file('image')->store('books', 'public');
            $validated['image'] = $imagePath;

            $book = Book::create($validated);
            $book->genres()->attach($request->genres);

            return redirect()->route('books.index')
                ->with('success', 'Book added successfully');

        } catch (\Throwable $th) {
            return redirect()->route('books.index')
                ->with('error_title', 'Error Adding Book')
                ->with('error_message', $th->getMessage());
        }
    }

    public function update(Request $request, Book $book)
    {
        try {
            $validated = $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'description' => 'required|string',
                'publisher' => 'required|string|max:255',
                'publication_date' => 'required|date',
                'category_id' => 'required|exists:categories,id',
                'total_copies' => 'required|integer|min:1',
                'genres' => 'required|array|exists:genres,id'
            ]);

            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($book->image);
                $validated['image'] = $request->file('image')->store('books', 'public');
            }

            $book->update($validated);
            $book->genres()->sync($request->genres);

            return redirect()->route('books.index')
                ->with('success', 'Book updated successfully');

        } catch (\Throwable $th) {
            return redirect()->route('books.index')
                ->with('error_title', 'Error Updating Book')
                ->with('error_message', $th->getMessage());
        }
    }

    public function edit(Book $book): View {
        $book = Book::with(['category', 'genres'])->findOrFail($book->id);
        $categories = Category::all();
        $genres = Genre::all();
        return view('librarian.books.edit', compact('book', 'categories', 'genres'));
    }

    public function destroy(Book $book)
    {
        try {
            $book = Book::findOrFail($book->id);
            
            $book->genres()->detach();
            
            if ($book->image) {
                Storage::delete($book->image);
            }
            
            $book->delete();
            
            return redirect()->back()->with('success', 'Book deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error_title', 'Delete Failed')
                ->with('error_message', 'Failed to delete the book. Please try again.' . $e->getMessage());
        }
    }
}
 