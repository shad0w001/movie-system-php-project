<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(15);

        return view('movies.index', compact('movies'));
    }

    public function search(Request $request)
    {
        if(!$request->filled('search')){
            $movies = Movie::paginate(15);
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
        ->orWhere('status','like','%'.$filteredSearchTerm.'%')
        ->orWhereHas('genres', function ($query) use ($filteredSearchTerm) {
            $query->where('name', 'like', "%$filteredSearchTerm%");
        })
        ->orWhereHas('producers', function ($query) use ($filteredSearchTerm) {
            $query->where('name', 'like', "%$filteredSearchTerm%");
        })
        ->paginate(15);

        return view('movies.index', ['movies' => $movies]);
        
    }

    public function show(Movie $movie)
    {
        return view('movies.movie', compact('movie'));
    }
}
