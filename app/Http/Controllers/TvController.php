<?php

namespace App\Http\Controllers;

use App\ViewModels\MovieViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularTv = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/popular?api_key=665100cfe69dc1eb7bb24003288d326e')
            ->json()['results'];


        $topRatedTv = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/top_rated?api_key=665100cfe69dc1eb7bb24003288d326e')
            ->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/tv/list?api_key=665100cfe69dc1eb7bb24003288d326e')
            ->json()['genres'];


        $viewModel = new TvViewModel(
            $popularTv,
            $topRatedTv,
            $genres
        );

        return view('tv.index', $viewModel);


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
        $tvshow = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/' . $id . '?api_key=665100cfe69dc1eb7bb24003288d326e&append_to_response=credits,videos,images')
            ->json();
       // dump($tvshow);

        $trialVideos = Http::withToken(config('services.tmdb.token'))
            //->get('https://api.themoviedb.org/3/movie/2?api_key=665100cfe69dc1eb7bb24003288d326e')
            ->get('https://api.themoviedb.org/3/tv/' . $id . '/videos?api_key=665100cfe69dc1eb7bb24003288d326e')
            ->json();
        //dump($trialVideos);

        $tvCredits = Http::withToken(config('services.tmdb.token'))
            //->get('https://api.themoviedb.org/3/movie/2?api_key=665100cfe69dc1eb7bb24003288d326e')
            ->get('https://api.themoviedb.org/3/tv/' . $id . '/credits?api_key=665100cfe69dc1eb7bb24003288d326e')
            ->json();
        //dump($tvCredits);



        return view('tv.show', [
            'tvshow' => $tvshow,
            'trialVideos'=>$trialVideos,
            'tvCredits'=>$tvCredits



        ]);


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
