<div class="py-2 text-gray-100">
    <div class="relative">
        <div class="w-full">
            <ul id="tabs" class="w-auto flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row gap-y-2">
                <li class="bg-blue-700 rounded -mb-px mr-2 last:mr-0 text-center">
                    <a class="text-gray-300 text-[15px] font-medium cursor-pointer transition-all ease-linear duration-100 rounded-md px-3 py-1 uppercase  block"
                        id="default-tab" href="#phimbo">Phim bộ mới</a>
                </li>
                <li class="-mb-px mr-2 last:mr-0 text-center">
                    <a class="text-gray-300 text-[15px] font-medium cursor-pointer transition-all ease-linear duration-100 rounded-md px-3 py-1 uppercase  block"
                        href="#phimle">Phim lẻ mới</a>
                </li>
            </ul>
            <div id="tab-contents">
                <div id="phimbo" class="grid grid-cols-2 gap-x-4 sm:gap-x-4 gap-y-3 md:grid-cols-4 pt-3">
                    @foreach ($phimbomoi as $movie)
                        <div>
                            <article
                                class="max-w-xs rounded-md group text-gray-50 relative overflow-hidden pb-2 bg-[#181818]">
                                <a title="Phim {{ $movie->name }} {{ $movie->publish_year }}" href="{{ $movie->getUrl() }}"
                                    class="relative"><img src="{{ $movie->getThumbUrl() }}"
                                        onerror="this.setAttribute('data-error', 1)" alt="{{ $movie->name }} {{ $movie->publish_year }}"
                                        loading="lazy" data-nuxt-img="" title="Phim {{ $movie->name }} {{ $movie->publish_year }}"
                                        class="object-cover object-center w-full rounded-xl sm:rounded-md h-60 bg-zinc-800 scale-105 group-hover:scale-110 ease-in duration-200"></a>
                                <div class="mt-3 px-2"><a title="Phim {{ $movie->name }} {{ $movie->publish_year }}"
                                        href="{{ $movie->getUrl() }}">
                                        <h3 class="text-[15px] font-medium capitalize pt-1 block truncate">
                                            {{ $movie->name }}</h3>
                                        <span class="text-sm font-medium text-gray-400">{{ $movie->publish_year }}</span>
                                    </a></div><span
                                    class="text-xs py-[3px] px-1 block rounded-br-md rounded-tr-md bg-[#408BEA] absolute top-2 left-0 shadow-lg shadow-red-900/20">{{ $movie->episode_current }} {{ $movie->lang }}</span>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div id="phimle" class="hidden grid grid-cols-2 gap-x-4 sm:gap-x-4 gap-y-3 md:grid-cols-4 pt-3">
                    @foreach ($phimlemoi as $movie)
                        <div>
                            <article
                                class="max-w-xs rounded-md group text-gray-50 relative overflow-hidden pb-2 bg-[#181818]">
                                <a title="Phim {{ $movie->name }} {{ $movie->publish_year }}" href="{{ $movie->getUrl() }}"
                                    class="relative"><img src="{{ $movie->getThumbUrl() }}"
                                        onerror="this.setAttribute('data-error', 1)" alt="{{ $movie->name }} {{ $movie->publish_year }}"
                                        loading="lazy" data-nuxt-img="" title="Phim {{ $movie->name }} {{ $movie->publish_year }}"
                                        class="object-cover object-center w-full rounded-xl sm:rounded-md h-60 bg-zinc-800 scale-105 group-hover:scale-110 ease-in duration-200"></a>
                                <div class="mt-3 px-2"><a title="Phim {{ $movie->name }} {{ $movie->publish_year }}"
                                        href="{{ $movie->getUrl() }}">
                                        <h3 class="text-[15px] font-medium capitalize pt-1 block truncate">
                                            {{ $movie->name }}</h3>
                                        <span class="text-sm font-medium text-gray-400">{{ $movie->publish_year }}</span>
                                    </a></div><span
                                    class="text-xs py-[3px] px-1 block rounded-br-md rounded-tr-md bg-[#408BEA] absolute top-2 left-0 shadow-lg shadow-red-900/20">{{ $movie->episode_current }} {{ $movie->lang }}</span>
                            </article>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>
    </div>
</div>
<script>
    let tabsContainer = document.querySelector("#tabs");

    let tabTogglers = tabsContainer.querySelectorAll("#tabs a");

    console.log(tabTogglers);

    tabTogglers.forEach(function(toggler) {
        toggler.addEventListener("click", function(e) {
            e.preventDefault();

            let tabName = this.getAttribute("href");

            let tabContents = document.querySelector("#tab-contents");

            for (let i = 0; i < tabContents.children.length; i++) {
                tabTogglers[i].parentElement.classList.remove(
                    "border-t",
                    "border-r",
                    "border-l",
                    "-mb-px",
                    "text-white",
                    "bg-blue-700"
                );
                tabContents.children[i].classList.remove("hidden");
                if ("#" + tabContents.children[i].id === tabName) {
                    continue;
                }
                tabContents.children[i].classList.add("hidden");
            }
            e.target.parentElement.classList.add(
                "text-white",
                "rounded",
                "bg-blue-700"
            );
        });
    });
</script>
