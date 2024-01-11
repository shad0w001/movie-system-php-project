<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie List</title>
</head>
<body>
    <h1>Movie List</h1>

    <form action="{{ route('movies.search') }}" method="GET">
        <input type="text" name="search" placeholder="Search for Movies">
        <button type="submit">Search</button>
    </form>

    {{-- Debugging code --}}
    @if($movies->isEmpty())
        <p>No movies found</p>
    @else
        <main>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Movies</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Year</th>
                                    <th>Status</th>
                                    <th>User Score</th>
                                    <th>Genres</th>
                                    <th>Producers</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($movies as $movie)
                                    <tr>
                                        <td>{{ $movie->name }}</td>
                                        <td>
                                        @if (!$movie->image) 
                                            <img src="{{ asset('storage/movies/default_movie.png') }}" width="120" alt="Default Movie Banner">  
                                            @else
                                                <img src="{{ asset($movie->image) }}" width="120" alt="Movie Banner">
                                            @endif
                                        </td>
                                        <td>
                                            {{ $movie->release_date ?: 'Undefined' }}
                                        </td>
                                        <td>
                                            {{ $movie->status }}
                                        </td>
                                        <td>
                                            {{-- Display score --}}
                                            @if ($movie->score == 0) 
                                                Undefined
                                            @else
                                                {{ $movie->score }}
                                            @endif
                                        </td>
                                        <td>
                                            {{-- Display genres --}}
                                                @if (!$movie->genres->isEmpty()) 
                                                    @foreach ($movie->genres as $genre)
                                                        {{ $genre->name }},
                                                    @endforeach
                                                @else
                                                    No genres
                                                @endif
                                        </td>
                                        <td>
                                            {{-- Display producers --}}
                                                @if (!$movie->producers->isEmpty())
                                                    @foreach ($movie->producers as $producer)
                                                        {{ $producer->name }},
                                                    @endforeach
                                                @else
                                                    No producers
                                                @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @endif
</body>
</html>