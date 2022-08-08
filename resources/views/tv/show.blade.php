@extends('layouts.main')
@section('content')


    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="{{'https://image.tmdb.org/t/p/w500'.$tvshow['poster_path']}}" alt="poster"
                     class="w-64 lg:w-96">
            </div>
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{$tvshow['name']}}</h2>
                <div class="flex items-center text-gray-400 text-sm">
                    <svg class="fill-current text-orange-500 w-4" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 47.94 47.94" style="enable-background:new 0 0 47.94 47.94" xml:space="preserve"><path
                            style="fill:#ed8a19"
                            d="m26.285 2.486 5.407 10.956a2.58 2.58 0 0 0 1.944 1.412l12.091 1.757c2.118.308 2.963 2.91 1.431 4.403l-8.749 8.528a2.582 2.582 0 0 0-.742 2.285l2.065 12.042c.362 2.109-1.852 3.717-3.746 2.722l-10.814-5.685a2.585 2.585 0 0 0-2.403 0l-10.814 5.685c-1.894.996-4.108-.613-3.746-2.722l2.065-12.042a2.582 2.582 0 0 0-.742-2.285L.783 21.014c-1.532-1.494-.687-4.096 1.431-4.403l12.091-1.757a2.58 2.58 0 0 0 1.944-1.412l5.407-10.956c.946-1.919 3.682-1.919 4.629 0z"/></svg>
                    <span class="ml-1">{{$tvshow['vote_average'] * 10 . '%'}} </span>
                    <span class="mx-2">|</span>
                    <span>{{\Carbon\Carbon::parse($tvshow['first_air_date'])->format('M d,Y')}}</span>
                    <span class="mx-2">|</span>
                    <span>
                        @foreach($tvshow['genres'] as$genre)
                            {{    $genre['name']}}
                            @if(count($tvshow['genres'])>= 2)
                                ,
                            @endif
                        @endforeach
                    </span>
                </div>
                <p class="text-gray-300 mt-8">
                    {{$tvshow['overview']}}
                </p>
                <div class="mt-12">
                    <h4 class="text-white font-semibold">Featured Cast</h4>
                    <div class="flex mt-4">
                        @foreach($tvshow['credits']['crew'] as $crew)
                            @if($loop->index < 2)
                                <div class="mr-8">
                                    <div style="margin-right:25px">{{$crew['name']}}</div>
                                    <div class="text-sm text-gray-400">{{$crew['job']}}</div>
                                </div>
                            @else
                                @break
                            @endif

                        @endforeach

                    </div>
                </div>
                <div x-data="{isOpen : false }">
                    @if(count($trialVideos) >0)
                        <div class="mt-12">
                            <button
                                @click="isOpen = true"
                                href="https://youtube.com/watch?v={{$trialVideos['id']}}"
                                class="flex inline-flex  items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transitionease-in-out duration-150">

                                <svg class="w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60"
                                     style="enable-background:new 0 0 60 60" xml:space="preserve"><path
                                        d="m45.563 29.174-22-15A1 1 0 0 0 22 15v30a.999.999 0 0 0 1.563.826l22-15a1 1 0 0 0 0-1.652zM24 43.107V16.893L43.225 30 24 43.107z"/>
                                    <path
                                        d="M30 0C13.458 0 0 13.458 0 30s13.458 30 30 30 30-13.458 30-30S46.542 0 30 0zm0 58C14.561 58 2 45.439 2 30S14.561 2 30 2s28 12.561 28 28-12.561 28-28 28z"/>
                        </svg>
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>
                    @endif
                    <div
                        style="background-color: rgba(0, 0, 0, .5);"
                        class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                        x-show="isOpen"
                    >
                        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                            <div class="bg-gray-900 rounded">
                                <div class="flex justify-end pr-4 pt-2">
                                    <button
                                        @click="isOpen = false"
                                        @keydown.escape.window="isOpen = false"
                                        class="text-3xl leading-none hover:text-gray-300">&times;
                                    </button>
                                </div>
                                <div class="modal-body px-8 py-8">
                                    <div class="responsive-container overflow-hidden relative"
                                         style="padding-top: 56.25%">
                                        <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                                src="https://www.youtube.com/embed/{{ $trialVideos['id'] }}"
                                                style="border:0;" allow="autoplay; encrypted-media"
                                                allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="movie-cast border-b border-gray-800">
            <div class="container mx-auto px-4 py-16">
                <h2 class="text-4xl font-semibold">Cast</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach($tvshow['credits']['cast'] as $cast)
                        @if($loop->index < 5)
                            <div class="mt-8">
                                <a href="{{route('actors.show',$cast['id'])}}">
                                    <img src="{{'https://image.tmdb.org/t/p/w300/'.$cast['profile_path']}}" alt="actor1"
                                         class="hover:opacity-75 transition ease-in-out duration-150">
                                </a>

                                <div class="mt-2">
                                    <a href="{{route('actors.show',$cast['id'])}}" class="text-lg mt-2 hover:text-gray:300">{{$cast['name']}}</a>
                                    <div class="flex items-center text-gray-400">
                                        <span class="ml-1">{{$cast['character']}}</span>
                                    </div>
                                </div>
                            </div>
                        @else
                            @break
                        @endif
                    @endforeach

                </div>
            </div>
        </div>

        <div class="movie-images" x-data="{ isOpen: false, image: ''}">
            <div class="container mx-auto px-4 py-16">
                <h2 class="text-4xl font-semibold">Images</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                    @foreach($tvshow['images']['backdrops'] as $image)

                        @if($loop->index<9)
                            <div class="mt-8">
                                <a
                                    @click.prevent="
                                isOpen = true
                                image='{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}'
                            "
                                    href="#">
                                    <img src="{{'https://image.tmdb.org/t/p/w500/'.$image['file_path']}}"
                                         alt=""
                                         class="hover:opacity-75 transition ease-in-out duration-150">
                                </a>
                            </div>

                        @endif


                    @endforeach

                </div>

                <div
                    style="background-color: rgba(0, 0, 0, .5);"
                    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                    x-show="isOpen"
                >
                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                        <div class="bg-gray-900 rounded">
                            <div class="flex justify-end pr-4 pt-2">
                                <button
                                    @click="isOpen = false"
                                    @keydown.escape.window="isOpen = false"
                                    class="text-3xl leading-none hover:text-gray-300">&times;
                                </button>
                            </div>
                            <div class="modal-body px-8 py-8">
                                <img :src="image" alt="poster">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection
