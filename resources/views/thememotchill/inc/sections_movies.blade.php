<div class="py-2">
    <div class="relative">
        <div>
            <h2
                class="text-xl font-normal text-gray-200 uppercase block pl-2 border-l-[3px] border-solid border-blue-500">
                {{ $item['label'] }}</h2>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-x-4 sm:gap-x-4 gap-y-3 md:grid-cols-4 lg:grid-cols-4 pt-3 xl:grid-cols-4">
        @foreach ($item['data'] as $key => $movie)
            @include('themes::thememotchill.inc.sections_movies_item')
        @endforeach
    </div>
</div>
