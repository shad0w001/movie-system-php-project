@extends('Layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Movie</h4>
                    </div>
                    <div class="card-body" sty>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Banner</th>
                                    <th>Title</th>
                                    <th>Release Date</th>
                                    <th>Status</th>
                                    <th>User Score</th>
                                    <th>Genres</th>
                                    <th>Producers</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        @if (!$movie->image) 
                                            <img src="{{ asset('storage/movies/default_movie.png') }}" width="120" alt="Default Movie Banner">  
                                        @else
                                            <img src="{{ asset($movie->image) }}" width="120" alt="Movie Banner">
                                        @endif
                                    </td>
                                    <td>{{ $movie->name }}</td>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection