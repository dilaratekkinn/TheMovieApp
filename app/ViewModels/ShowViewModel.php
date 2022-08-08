<?php

namespace App\ViewModels;

use Illuminate\Support\Carbon;
use Spatie\ViewModels\ViewModel;

class ShowViewModel extends ViewModel
{
    public $movieDetails;
    public $movieCredits;
    public $trialVideos;
    public $img;


    public function __construct($movieDetails, $movieCredits, $trialVideos, $img)
    {

        $this->movieDetails = $movieDetails;
        $this->movieCredits = $movieCredits;
        $this->trialVideos = $trialVideos;
        $this->img = $img;

    }

    public function movieDetails()
    {
       // return collect($this->movieDetails)->dump();
        return collect($this->movieDetails)->map(function($movieDetails){
            return collect($movieDetails)->merge([
//                'poster_path'=>'https://image.tmdb.org/t/p/w500'.$movieDetails['poster_path'],
//                'vote_average'=>$movieDetails['vote_average'] * 10 . '%',
                'poster_path'=>'foo',

            ]);
        });

    }

    public function movieCredits()
    {

    }

    public function trialVideos()
    {
        return $this->trialVideos;
    }

    public function img()
    {
        return $this->img;
    }


    private function showMovies($movieDetails)
    {


//        return collect($movieDetails)->map(function () use ($movieDetails){
//
//
//            return collect($movieDetails)->merge([
//                'poster_path' => 'https://image.tmdb.org/t/p/w500/' .$movieDetails['poster_path'],
//                'vote_average'=>$movieDetails['vote_average'] * 10 . '%',
//                'release_date'=>Carbon::parse($movieDetails['release_date'])->format('M d,Y'),


    }


}
