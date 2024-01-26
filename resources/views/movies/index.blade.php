@extends('layouts.app')

@section('content')

<style>
    div#searchBox {
        float: none;
        text-align: center;
        color: #777;
        margin-top: 4em;
    }

    #searchform {
        border-bottom: 1px solid #ccc;
        padding: 8px 0 0;
    }

    #searchform input {
        border: 0px;
        background: transparent;
        padding: 8px 10px 5px;
        outline: none;
    }

    .mobile-form #searchform {
        padding-top: 2.5px;
        width: 215px;
    }

    div#searchBox #searchform {
        border: 1px solid #ddd;
        width: 238px;
        padding-top: 1px;
        display: inline-block;
    }

    div#searchBox #searchform input {
        padding: 5px;
        display: block;
    }

    #searchBox i.fa.fa-search {
        padding: 8px;
        cursor: pointer;
    }

    .sb-icon-search,
    .sb-search-submit {
        width: 30px;
        height: 30px;
        display: block;
        position: absolute;
        right: 0;
        top: 0;
        padding: 0;
        margin: 0;
        line-height: 30px;
        text-align: center;
        cursor: pointer;
    }

    .sb-search-submit {
        background: #fff;
        /* IE needs this */
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        /* IE 8 */
        filter: alpha(opacity=0);
        /* IE 5-7 */
        opacity: 0;
        color: transparent;
        border: none;
        outline: none;
        z-index: 100;
    }

    div#searchBox #searchform .sb-icon-search {
        /* color: #fff; */
        /* background: #3f91c3; */
        z-index: 90;
        /* font-size: 22px; */
        font-family: 'FontAwesome';
        speak: none;
        font-style: normal;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        -webkit-font-smoothing: antialiased;
        top: -1px;
    }

    div#searchBox #searchform .sb-icon-search:before {
        content: "\f002";
    }

    span#noEasy {
        display: block;
        /* overflow: hidden; */
        position: relative;
        width: 30px;
        height: 30px;
        float: left;
        padding-left: 3px;
    }

    span#noEasy input {
        width: 30px;
        padding: 0 !important;
    }

    input#sbox {
        line-height: 31px;
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }

    span#noEasy:hover {
        color: #444;
    }




    *{
        margin: 0px;
        padding: 0px;
    }

    body{
        font-family: arial;
    }
    .main{
        margin: 2%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card{
        width: 15%;
        display: inline-block;
        box-shadow: 2px 2px 20px black;
        border-radius: 5px; 
        margin: 2%;
    }

    .image img{
        width: 100%;
        border-top-right-radius: 5px;
        border-top-left-radius: 5px;  
    }

    .title{
    
        text-align: center;
        padding: 10px 0px 10px 10px;
    
    }

    h1{
    font-size: 20px;
    }

    .des{
        padding: 3px;
        text-align: center;
        
        padding-top: 0px;
        border-bottom-right-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    button{
    margin-top: 10px;
    margin-bottom: 10px;
    background-color: white;
    border: 1px solid white;
    border-radius: 5px;
    padding:10px;
    }

    button:hover{
    background-color: #e1ebfa;
    color: black;
    transition: .5s;
    cursor: pointer;
    }
</style>


    <div id="searchBox" class="mobile-form">
        <form lass="search-form" id="searchform" action="{{ route('movies.search') }}" method="GET">
            <span id="noEasy">
                <input onclick="document.getElementById('searchform').submit();" class="sb-search-submit" type="submit">
                <span class="sb-icon-search"></span>
            </span>
            <input id="sbox" name="search" onblur="if (this.placeholder == '') {this.placeholder = 'To search type + hit enter';}" onfocus="if (this.placeholder == 'To search type + hit enter') {this.placeholder = '';}" placeholder="Search for Movies" x-webkit-speech="">
        </form>
    </div>

    <div class="main">
    {{-- Debugging code --}}
    @if($movies->isEmpty())
    <div class="card">

        <div class="image">
            <img src="{{ asset('storage/movies/default_movie.png') }}" width="100" height="300" alt="Default Movie Banner">
        </div>
        <div class="title">
            <h1>No movies foind</h1>
        </div>
        <div class="des">
            <p>There were no results from your search query.</p>
        </div>
    </div>
    @else
    @foreach ($movies as $movie)
	<div class="card">

		<div class="image">
            @if (!$movie->image) 
                <img src="{{ asset('storage/movies/default_movie.png') }}" width="100" height="300" alt="Default Movie Banner">  
            @else
                <img src="{{ asset($movie->image) }}" width="100" height="300" alt="Movie Banner">
            @endif
		</div>
		<div class="title">
			<h1>{{ $movie->name }}</h1>
		</div>
		<div class="des">
            <p>Status: {{ $movie->status }}</p>
            <p> Release Date: {{ $movie->release_date ?: 'Undefined' }}</p>
			<button>
                <a style="text-decoration:none" href="{{ route('movies.show', $movie) }}" target="_blank" class="subtitle-link">
                    Click to view more
                </a>
            </button>
		</div>
	</div>
        @endforeach
    @endif
    </div>
@endsection