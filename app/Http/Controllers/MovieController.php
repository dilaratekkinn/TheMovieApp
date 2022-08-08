<?php

namespace App\Http\Controllers;

use App\ViewModels\MovieViewModel;
use App\ViewModels\ShowViewModel;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular?api_key=665100cfe69dc1eb7bb24003288d326e')
            ->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list?api_key=665100cfe69dc1eb7bb24003288d326e')
            ->json()['genres'];

//        $genres = collect($genresMovies)->mapWithKeys(function ($genre) {
//            return [$genre['id'] => $genre['name']];
//        });

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing?api_key=665100cfe69dc1eb7bb24003288d326e')
            ->json()['results'];


        // dump($nowPlayingMovies);

//
//        return view('layouts.index', [
//            'popularMovies' => $popularMovies,
//            'nowPlayingMovies' => $nowPlayingMovies,
//            'genres' => $genres
//        ]);

        $viewModel = new MovieViewModel(
           $popularMovies,
            $nowPlayingMovies,
            $genres
        );

        return view('movies.index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movieDetails = Http::withToken(config('services.tmdb.token'))
            //->get('https://api.themoviedb.org/3/movie/2?api_key=665100cfe69dc1eb7bb24003288d326e')
            ->get('https://api.themoviedb.org/3/movie/' . $id . '?api_key=665100cfe69dc1eb7bb24003288d326e')
            ->json();
        // dump($movieDetails);

        $movieCredits = Http::withToken(config('services.tmdb.token'))
            //->get('https://api.themoviedb.org/3/movie/2?api_key=665100cfe69dc1eb7bb24003288d326e')
            ->get('https://api.themoviedb.org/3/movie/' . $id . '/credits?api_key=665100cfe69dc1eb7bb24003288d326e')
            ->json();

        //dump($movieCredits);

        $trialVideos = Http::withToken(config('services.tmdb.token'))
            //->get('https://api.themoviedb.org/3/movie/2?api_key=665100cfe69dc1eb7bb24003288d326e')
            ->get('https://api.themoviedb.org/3/movie/' . $id . '/videos?api_key=665100cfe69dc1eb7bb24003288d326e')
            ->json();
        // dump($trialVideos);

        $img = Http::withToken(config('services.tmdb.token'))
            //->get('https://api.themoviedb.org/3/movie/2?api_key=665100cfe69dc1eb7bb24003288d326e')
            ->get('https://api.themoviedb.org/3/movie/' . $id . '/images?api_key=665100cfe69dc1eb7bb24003288d326e')
            ->json();

        // dump($img);



      return view('movies.show', [
            'movieDetails' => $movieDetails,
            'movieCredits' => $movieCredits,
            'trialVideos' => $trialVideos,
            'img' => $img,
        ]);


//         $viewModel = new ShowViewModel(
//            $movieDetails,
//            $movieCredits,
//            $trialVideos,
//            $img
//        );
//
//        return view('layouts.show', $viewModel);




    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
