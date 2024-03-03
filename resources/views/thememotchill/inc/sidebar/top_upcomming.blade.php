<div class="pt-4">
    <div>
        <section class="text-gray-600 body-font py-4">
            <div class="flex flex-col w-full mb-2">
                <span
                    class="uppercase text-gray-200 text-xl font-normal border-dashed border-b border-zinc-600 w-full block pb-2">{{ $top['label'] }}</span>
            </div>
            <div class="-m-2">
                @foreach ($top['data'] as $key => $movie)
                    <div class="p-1 w-full">
                        <div class="h-full flex border-zinc-800 border p-2 rounded-sm gap-2"><a class="w-20 h-20"
                                href="{{ $movie->getUrl() }}" title="{{ $movie->name }}"><img
                                    src="{{ $movie->getThumbUrl() }}" alt="{{ $movie->name }}" data-nuxt-img=""
                                    title="{{ $movie->name }}"
                                    class="w-full h-full object-cover object-center rounded-md"></a>
                            <div class="w-3/5 truncate">
                                <a href="{{ $movie->getUrl() }}" class="text-gray-300 text-[14px] truncate font-medium"
                                    title="{{ $movie->name }}">{{ $movie->name }}</a>
                                <span class="text-zinc-400 text-sm block">{{ $movie->publish_year }}</span>
                                <ul class="my-1 flex list-none gap-1 p-0" data-te-rating-init>
                                    <li>
                                        <span class="text-primary [&>svg]:h-5 [&>svg]:w-5" title="Bad"
                                            data-te-rating-icon-ref>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="#f0a700" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                            </svg>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="text-primary [&>svg]:h-5 [&>svg]:w-5" title="Poor"
                                            data-te-rating-icon-ref>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="#f0a700" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                            </svg>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="text-primary [&>svg]:h-5 [&>svg]:w-5" title="OK"
                                            data-te-rating-icon-ref>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="#f0a700" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                            </svg>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="text-primary [&>svg]:h-5 [&>svg]:w-5" title="Good"
                                            data-te-rating-icon-ref>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="#f0a700" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                            </svg>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="text-primary [&>svg]:h-5 [&>svg]:w-5" title="Excellent"
                                            data-te-rating-icon-ref>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="#f0a700" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                            </svg>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</div>
