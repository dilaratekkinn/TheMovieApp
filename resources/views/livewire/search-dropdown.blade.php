<div class="relative mt-3 md:mt-0 " x-data="{isOpen : true}" @click.away="isOpen = false">
    <input wire:model.debounce.500ms="search" type="text"
           class="bg-gray-800 text-sm rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline"
           placeholder="search"
           x-ref="search"
           @keydown.window="
            if (event.keyCode === 191) {
                event.preventDefault();
                $refs.search.focus();
            }
        "
           @focus="isOpen=true"
           @keydown="isOpen=true"
           @keydown.escape.window="isOpen = false"
           @keydown.shift.tab="isOpen=false"

    >
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 451 451" style="enable-background:new 0 0 451 451" xml:space="preserve"><path
                d="m447.05 428-109.6-109.6c29.4-33.8 47.2-77.9 47.2-126.1C384.65 86.2 298.35 0 192.35 0 86.25 0 .05 86.3.05 192.3s86.3 192.3 192.3 192.3c48.2 0 92.3-17.8 126.1-47.2L428.05 447c2.6 2.6 6.1 4 9.5 4s6.9-1.3 9.5-4c5.2-5.2 5.2-13.8 0-19zM26.95 192.3c0-91.2 74.2-165.3 165.3-165.3 91.2 0 165.3 74.2 165.3 165.3s-74.1 165.4-165.3 165.4c-91.1 0-165.3-74.2-165.3-165.4z"/></svg>
    </div>
    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>
    @if(strlen($search) >=2)
        <div class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-4"
             x-show.transition.opacity="isOpen"

        >
            @if($searchResults->count()>0)
                <ul>
                    @foreach($searchResults as $result)
                        <li class="border-bd border-gray-700">
                            <a
                                href="{{route('movies.show',$result['id'])}}"
                                class="block hover:bg-gray-700 px-3 py-3 flex items-center transition ease-in-out duration-150"
                                @if($loop ->last) @keydown.tab="isOpen = false"@endif>
                                @if($result['poster_path'])
                                    <img src="https://image.tmdb.org/t/p/w92/{{$result['poster_path']}}" alt="poster"
                                         class="w-8">
                                    <span class="ml-4">{{$result['title']}}</span>
                                @else
                                    <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">
                                @endif
                            </a>
                        </li>
                    @endforeach

                </ul>
            @else
                <div class="px-3 py-3">No results for "{{$search}}"</div>
            @endif

        </div>
    @endif

</div>
