@if ($recommendations)
<div class="myui-top-movies">
    <h2 class="text-xl font-normal text-gray-200 uppercase pl-2 border-l-[3px] border-solid border-blue-500">
        {{ $recommendations['label'] }}</h2>
    <div class="flickity clearfix">

        @foreach ($recommendations['data'] as $movie)
            <div class="pt-3 col-lg-5 col-md-5 col-sm-4 col-xs-3">
                <article class="pr-4 max-w-xs rounded-md group text-gray-50 relative overflow-hidden pb-2">
                    <a
                        href="{{$movie->getUrl()}}"
                        class="relative"
                        title="{{$movie->name}}"

                    >
                        <img src="{{$movie->getThumbUrl()}}" class="object-cover object-center w-full rounded-xl sm:rounded-md h-60 bg-zinc-800 scale-105 group-hover:scale-110 ease-in duration-200">
                        <span class="play hidden-xs"></span>
                        <div class="mt-3 absolute bottom-0 left-0 p-2 bg-gradient-to-b from-transparent to-black w-full">
                            <a title="{{ $movie->name }}" href="{{ $movie->getUrl() }}">
                                <h3 class="text-[15px] font-medium capitalize pt-1 block truncate">
                                    {{ $movie->name }}</h3>
                                <span class="text-sm text-gray-300 font-medium">{{ $movie->publish_year }}</span>
                            </a>
                        </div>
                        <span class="text-xs py-1 px-2 block rounded-br-md rounded-tr-md bg-[#408BEA] absolute top-2 left-0 shadow-lg shadow-red-900/20">{{$movie->episode_current}} {{$movie->language}}</span>

                    </a>
                </article>
            </div>
        @endforeach
    </div>
</div>
@endif
