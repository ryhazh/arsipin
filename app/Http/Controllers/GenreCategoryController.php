<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Category;
use Illuminate\Http\Request;

class GenreCategoryController extends Controller
{
    public function index(Request $request) {
        $genres = Genre::all();
        $currentUser = auth()?->user();

        $categories = Category::all();
        return view('librarian.genrescategories.index', compact('genres', 'categories', 'currentUser'));
    }
}
