<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(10);

        return view('movies.index', compact('movies'));
    }

    public function search(Request $request)
    {
        if(!$request->filled('search')){
            $movies = Movie::paginate(10);
            return view('movies.index', compact('movies'));
        }

        //validating against special html characters
        $request->validate([
            'search' => 'required|string|not_regex:/[\W]/',
        ]);

        $searchTerm = $request->input('search');

        $filteredSearchTerm = preg_replace('/[\W]/', '', $searchTerm);

        $movies=Movie::where('name','like','%'.$filteredSearchTerm.'%')
        ->orWhere('release_date','like','%'.$filteredSearchTerm.'%')
        ->orWhereHas('genres', function ($query) use ($searchTerm) {
            $query->where('name', 'like', "%$searchTerm%");
        })
        ->orWhereHas('producers', function ($query) use ($searchTerm) {
            $query->where('name', 'like', "%$searchTerm%");
        })
        ->paginate(10);

        return view('movies.index', ['movies' => $movies]);
        
    }
}
