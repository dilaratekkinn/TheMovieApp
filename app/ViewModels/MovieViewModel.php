<?php

namespace App\ViewModels;

use Illuminate\Support\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $popularMovies;
    public $nowPlayingMovies;
    public $genres;

    public function __construct($popularMovies, $nowPlayingMovies, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->genres = $genres;
    }

    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }

    public function nowPlayingMovies()
    {
     return $this->formatMovies($this->nowPlayingMovies);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
       });
    }

    private function formatMovies($popularMovie){

        return collect($popularMovie)->map(function ($popularMovie) {
            $genresFormatted=collect($popularMovie['genre_ids'])->mapWithKeys(function ($value){
                return[$value=>$this->genres()->get($value)];
            })->implode(', ');

            return collect($popularMovie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $popularMovie['poster_path'],
                'vote_average'=>$popularMovie['vote_average'] * 10 . '%',
                'release_date'=>Carbon::parse($popularMovie['release_date'])->format('M d,Y'),
                'genres'=>$genresFormatted,

            ]);
        });

    }


}
