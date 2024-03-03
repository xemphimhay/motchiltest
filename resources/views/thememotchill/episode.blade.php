@extends('themes::thememotchill.layout')

@section('content')
    <style>
        .video-footer {
            margin-top: 5px;
        }

        .btn-active {
            color: #fff !important;
            background: #d9534f !important;
            border-color: #d9534f !important;
        }

        .btn-sv {
            margin-right: 5px;
        }

        .btn-sv:last-child {
            margin-right: 0;
        }

        #player-loaded>div {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
        }
    </style>

    <div class>
        <div class="pt-2 grid grid-cols-12 gap-x-5">
            <section class="col-span-12">
                <nav class="flex px-2.5 py-2 text-gray-700 border rounded-md bg-[#181818] border-zinc-900 shadow-lg shadow-black/20"
                    aria-label="Breadcrumb">
                    <ol class="inline-flex flex-wrap items-center space-x-1 md:space-x-3"><!--[-->
                        <li class="inline-flex items-center">
                            <a title="Trang Chủ" href="/"
                                class="inline-flex items-center text-sm font-medium text-blue-500 hover:blue-600 whitespace-nowrap">
                                <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg> Trang Chủ
                            </a>
                        </li>
                        @foreach ($currentMovie->regions as $region)
                            <li class="inline-flex items-center">
                                <a title="{{ $region->name }}" href="{{ $region->getUrl() }}"
                                    class="inline-flex items-center text-sm font-medium text-blue-500 hover:blue-600 whitespace-nowrap">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5">
                                        </path>
                                    </svg> {{ $region->name }}
                                </a>
                            </li>
                        @endforeach
                        <li class="inline-flex items-center">
                            <a title="{{ $currentMovie->name }}" href="{{ $currentMovie->getUrl() }}"
                                class="inline-flex items-center text-sm font-medium text-blue-500 hover:blue-600 whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5">
                                    </path>
                                </svg> {{ $currentMovie->name }}
                            </a>
                        </li>
                        <li class="inline-flex items-center">
                            <span
                                class="inline-flex items-center text-sm font-medium text-gray-200 hover:text-white whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5">
                                    </path>
                                </svg> Tập {{ $episode->name }}
                            </span>
                        </li>
                    </ol>
                </nav>
                <div>
                    <div class="m-auto w-full my-2">
                        <div class="py-2 px-1 bg-black border border-blue-900 text-sm my-2">Motphim có địa chỉ là
                            {{ request()->getHost() }}, cả nhà chia sẻ để ủng hộ mình nhé !</div>
                        <div class="transform relative player-wrapper">
                            <div id="main-player">
                                {{-- <div class="loader"></div> --}}
                                <div id="player-loaded"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-[20px]">
                        <div class="flex justify-end">
                            <span class="video-btn report" id="report_error" title="Báo lỗi cho admin">
                                <i class="fa fa-bug"></i>
                                <span>Báo Lỗi</span>
                            </span>
                            <div class="video-btn"><i class="fa fa-eye"></i>
                                <span>{{ $currentMovie->view_total }}</span> lượt xem
                            </div>
                            {{-- <div class="video-btn onclick="onclick="goToNextEpisode()">
                                <i class="fa fa-arrow-right"></i>
                                <span>Tập tiếp</span>

                            </div> --}}
                        </div>
                        <div class="flex flex-row pt-2">
                            <div class="basis-1/4"></div>
                            <div class="basis-2/4 text-center">
                                <span class="text-sm font-bold pb-2 block">Đổi Server (Nếu Lag)</span>
                                <div class="flex flex-row flex-wrap gap-1.5 items-center justify-center min-h-[35px]">
                                    <div>
                                        <div id="ploption" class="text-center">
                                            @foreach ($currentMovie->episodes->where('slug', $episode->slug)->where('server', $episode->server) as $server)
                                                <a onclick="chooseStreamingServer(this)" data-type="{{ $server->type }}"
                                                    data-id="{{ $server->id }}" data-link="{{ $server->link }}"
                                                    class="streaming-server text-gray-300 px-2 py-2 text-xs font-medium rounded">
                                                    Server #{{ $loop->iteration }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="basis-1/4"></div>
                        </div>
                        <center class="pb-1"><b>Tìm tập phim nhanh</b>: <input type="text" id="searchBox"
                                placeholder="VD: 108"
                                style="background: 0 0; border: 1px solid #fff; height: 32px; width: 100px; padding: 5px;">
                        </center>
                        <center style="display:none" id="episode_error">
                            <input type="text" name="error_message" placeholder="Điền chi tiết lỗi">
                            <input type="button" id="error_send" value="Gửi">
                        </center>
                    </div>
                    <div>
                        <div class="myui-panel_hd">
                            <div class="myui-panel__head active bottom-line clearfix">
                                <div class="title">Tập phim</div>
                                <ul class="nav nav-tabs active">
                                    @foreach ($currentMovie->episodes->sortBy([['server', 'asc']])->groupBy('server') as $server => $data)
                                        <li class="{{ $loop->index == 0 ? 'active' : '' }}"><a
                                                href="#tab_{{ $loop->index }}">{{ $server }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="tab-content myui-panel_bd">
                            @foreach ($currentMovie->episodes->sortBy([['server', 'asc']])->groupBy('server') as $server => $data)
                                <div class="tab-pane fade in clearfix {{ $loop->index == 0 ? 'active' : '' }}"
                                    id="tab_{{ $loop->index }}">
                                    <ul class="myui-content__list sort-list clearfix"
                                        style="max-height: 300px; overflow: auto;">
                                        @foreach ($data->sortBy('name', SORT_NATURAL)->groupBy('name') as $name => $item)
                                            <li class="col-lg-8 col-md-7 col-sm-6 col-xs-4">
                                                <a href="{{ $item->sortByDesc('type')->first()->getUrl() }}"
                                                    class="text-gray-300 bg-neutral-600 hover:bg-neutral-700 text-center font-medium min-w-[64px] text-[13px] px-2 py-1.5 mb-2 mr-1.5 rounded-sm @if ($item->contains($episode)) bg-orange-900 @endif"
                                                    title="{{ $name }}">{{ $name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="border-t border-gray-800 border-opacity-75 pt-3 mt-2">
                        <h1 class="text-[#da966e] font-bold text-xl uppercase inline-block">{{ $currentMovie->name }}
                            Tập {{ $episode->name }}</h1>
                        <h2 class="pt-1 text-xl">{{ $currentMovie->name }} -
                            {{ $currentMovie->origin_name }} Tập {{ $episode->name }} {{ $currentMovie->language }}
                            ({{ $currentMovie->publish_year }})</h2>
                        <h2 class="text-md text-zinc-400 font-bold my-2">Tập {{ $episode->name }}</h2>
                        <h3 class="text-md text-zinc-400 font-bold my-2">Lượt xem:
                            {{ motchill_format_view($currentMovie->view_total) }}</h3>
                        @include('themes::thememotchill.inc.rating2')
                        <div class="mt-2 bg-[#222222] p-1 text-gray-400 text-justify">
                            <div class="pt-2 inline">
                                {!! mb_substr(strip_tags($currentMovie->content), 0, 1000, 'utf-8') !!}...
                                <a class="text-blue-600 text-sm font-medium whitespace-nowrap"
                                    href="{{ $currentMovie->getUrl() }}"
                                    title="{{ $currentMovie->name }} - {{ $currentMovie->origin_name }} ({{ $currentMovie->publish_year }})">Xem
                                    thêm</a>
                            </div>
                        </div>
                        <div class="sharing-buttons flex flex-wrap items-center py-2 mt-2">
                            <span class="text-sm text-gray-400 mr-3">Chia Sẻ</span>
                            <a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1.5 transition p-1 rounded text-white border-[#1877F2] bg-[#1877F2] hover:opacity-90"
                                target="_blank" rel="noopener"
                                href="https://facebook.com/sharer/sharer.php?u={{ $currentMovie->getUrl() }}"
                                aria-label="Share on Facebook"><svg aria-hidden="true" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4">
                                    <title>Facebook</title>
                                    <path
                                        d="M379 22v75h-44c-36 0-42 17-42 41v54h84l-12 85h-72v217h-88V277h-72v-85h72v-62c0-72 45-112 109-112 31 0 58 3 65 4z">
                                    </path>
                                </svg>
                            </a>
                            <a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1.5 transition p-1 rounded text-white border-[#1DA1F2] bg-[#1DA1F2] hover:opacity-90"
                                target="_blank" rel="noopener"
                                href="https://twitter.com/intent/tweet?url={{ $currentMovie->getUrl() }}"
                                aria-label="Share on Twitter"><svg aria-hidden="true" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4">
                                    <title>Twitter</title>
                                    <path
                                        d="m459 152 1 13c0 139-106 299-299 299-59 0-115-17-161-47a217 217 0 0 0 156-44c-47-1-85-31-98-72l19 1c10 0 19-1 28-3-48-10-84-52-84-103v-2c14 8 30 13 47 14A105 105 0 0 1 36 67c51 64 129 106 216 110-2-8-2-16-2-24a105 105 0 0 1 181-72c24-4 47-13 67-25-8 24-25 45-46 58 21-3 41-8 60-17-14 21-32 40-53 55z">
                                    </path>
                                </svg></a>
                        </div>
                        @if ($currentMovie->showtimes && $currentMovie->showtimes != '')
                            <div class="text-base p-2 bg-black my-3 border border-blue-900">
                                <h3 class="text-base inline-block">Lịch Chiếu: </h3>
                                <span class="pt-2 text-gray-300">{!! strip_tags($currentMovie->showtimes) !!}</span>
                            </div>
                        @endif
                        <div class="mt-2 border-t border-gray-800 border-opacity-75">
                            <span
                                class="flex text-gray-300 text-md mt-2 items-center text-medium font-bold text-2md uppercase">
                                Để Lại Bình Luận</span>
                            <div class="bg-white mt-4">
                                <div data-order-by="reverse_time" id="commit-99011102" class="fb-comments"
                                    data-href="{{ $currentMovie->getUrl() }}" data-width="" data-numposts="10">
                                </div>
                                <script>
                                    document.getElementById("commit-99011102").dataset.width = $("#commit-99011102").parent().width();
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 pb-2 border-t border-gray-800 border-opacity-75"><i
                            class="text-sm block pt-2 text-gray-200">Từ
                            Khóa :</i> <span class="text-gray-200 text-sm">xem phim {{ $episode->name }} full vietsub,
                            thuyết minh,
                            xem
                            phim {{ $episode->name }} full hd, {{ $episode->origin_name }} full vietsub, thuyết minh,
                            motchill, motphim, phimmoi, tvhay, hayghe, subnhanh, bichill, vieon, fptplay, netflix,
                            youtube, bilutv, phim1080, fullphim, dongphim, tvzing, luotphim, wetv, phimchill, ssphim,
                            motphimtv, hitv, netflix</span></div>

                    <div class="w-full my-1"></div>
                    <div>
                        <section class="pt-4 py-4">
                            <span class="text-gray-200 font-semibold uppercase pl-2 py-3 block text-md"><span
                                    class="inline-block"><svg aria-hidden="true" focusable="false" data-prefix="far"
                                        data-icon="star" class="w-4 text-yellow-500 mr-1" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path fill="currentColor"
                                            d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z">
                                        </path>
                                    </svg></span>Phim Đề Cử</span>
                            <div class="grid grid-cols-2 gap-x-2 gap-y-4 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                                @foreach ($movie_related as $movie)
                                    <div>
                                        <article
                                            class="max-w-xs rounded-md group text-gray-50 relative overflow-hidden pb-2 bg-[#181818]">
                                            <a class="relative"
                                                title="Phim {{ $movie->name }} {{ $movie->publish_year }}"
                                                href="{{ $movie->getUrl() }}" class="relative"><img
                                                    src="{{ $movie->getThumbUrl() }}"
                                                    alt="{{ $movie->name }} {{ $movie->publish_year }}" loading="lazy"
                                                    data-nuxt-img="" title="{{ $movie->name }}"
                                                    class="object-cover object-center w-full rounded-xl sm:rounded-md h-60 bg-zinc-800 scale-105 group-hover:scale-110 ease-in duration-200"></a>
                                            <div class="mt-3 px-2">
                                                <a title="{{ $movie->name }}" href="{{ $movie->getUrl() }}">
                                                    <span class="text-[15px] font-medium capitalize pt-1 block truncate">
                                                        {{ $movie->name }}
                                                    </span>
                                                    <span
                                                        class="text-sm font-medium text-gray-400">{{ $movie->publish_year }}</span>
                                                </a>
                                            </div>
                                            <span
                                                class="text-xs py-[3px] px-1 block rounded-br-md rounded-tr-md bg-[#408BEA] absolute top-2 left-0 shadow-lg shadow-red-900/20">{{ $movie->episode_current }}
                                                {{ $movie->language }}</span>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    </div>
            </section>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="/themes/motchill/static/player/skin/juicycodes.js"></script>
    <link href="/themes/motchill/static/player/skin/juicycodes.css" rel="stylesheet" type="text/css">

    {{--    <script src="/themes/motchill/static/player/js/p2p-media-loader-core.min.js"></script> --}}
    {{--    <script src="/themes/motchill/static/player/js/p2p-media-loader-hlsjs.min.js"></script> --}}

    <script src="/themes/motchill/static/player/jwplayer.js"></script>
    <script>
        var episode_id = {{ $episode->id }};
        const wrapper = document.getElementById('player-loaded');
        const vastAds = "{{ Setting::get('jwplayer_advertising_file') }}";

        function chooseStreamingServer(el) {
            const type = el.dataset.type;
            const link = el.dataset.link.replace(/^http:\/\//i, 'https://');
            const id = el.dataset.id;

            const newUrl =
                location.protocol +
                "//" +
                location.host +
                location.pathname.replace(`-${episode_id}`, `-${id}`);

            history.pushState({
                path: newUrl
            }, "", newUrl);
            episode_id = id;

            Array.from(document.getElementsByClassName('streaming-server')).forEach(server => {
                server.classList.remove('bg-[#A3765D]');
            })
            el.classList.add('bg-[#A3765D]')

            renderPlayer(type, link, id);
        }

        function renderPlayer(type, link, id) {
            if (type == 'embed') {
                if (vastAds) {
                    wrapper.innerHTML = `<div id="fake_jwplayer"></div>`;
                    const fake_player = jwplayer("fake_jwplayer");
                    const objSetupFake = {
                        key: "{{ Setting::get('jwplayer_license') }}",
                        aspectratio: "16:9",
                        width: "100%",
                        file: "/themes/motchill/static/player/1s_blank.mp4",
                        volume: 100,
                        mute: false,
                        autostart: true,
                        advertising: {
                            tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                            client: "vast",
                            vpaidmode: "insecure",
                            skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                            skipmessage: "Bỏ qua sau xx giây",
                            skiptext: "Bỏ qua"
                        }
                    };
                    fake_player.setup(objSetupFake);
                    fake_player.on('complete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });
                    fake_player.on('adSkipped', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });
                    fake_player.on('adComplete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });
                } else {
                    if (wrapper) {
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                    }
                }
                return;
            }

            if (type == 'm3u8' || type == 'mp4') {
                wrapper.innerHTML = `<div id="jwplayer"></div>`;
                const player = jwplayer("jwplayer");
                const objSetup = {
                    key: "{{ Setting::get('jwplayer_license') }}",
                    aspectratio: "16:9",
                    width: "100%",
                    file: link,
                    image: "{{ $currentMovie->getPosterUrl() }}",
                    autostart: true,
                    controls: true,
                    primary: "html5",
                    playbackRateControls: true,
                    playbackRates: [0.5, 0.75, 1, 1.5, 2],
                    // sharing: {
                    //     sites: [
                    //         "reddit",
                    //         "facebook",
                    //         "twitter",
                    //         "googleplus",
                    //         "email",
                    //         "linkedin",
                    //     ],
                    // },
                    volume: 100,
                    mute: false,
                    logo: {
                        file: "{{ Setting::get('jwplayer_logo_file') }}",
                        link: "{{ Setting::get('jwplayer_logo_link') }}",
                        position: "{{ Setting::get('jwplayer_logo_position') }}",
                    },
                    advertising: {
                        tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                        client: "vast",
                        vpaidmode: "insecure",
                        skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                        skipmessage: "Bỏ qua sau xx giây",
                        skiptext: "Bỏ qua",
                        admessage: "Quảng cáo còn xx giây."
                    },
                    tracks: [{
                        "file": "/sub.vtt",
                        "kind": "captions",
                        label: "VN",
                        default: "true"
                    }],
                };

                if (type == 'm3u8') {
                    const segments_in_queue = 50;

                    var engine_config = {
                        debug: !1,
                        segments: {
                            forwardSegmentCount: 50,
                        },
                        loader: {
                            cachedSegmentExpiration: 864e5,
                            cachedSegmentsCount: 1e3,
                            requiredSegmentsPriority: segments_in_queue,
                            httpDownloadMaxPriority: 9,
                            httpDownloadProbability: 0.06,
                            httpDownloadProbabilityInterval: 1e3,
                            httpDownloadProbabilitySkipIfNoPeers: !0,
                            p2pDownloadMaxPriority: 50,
                            httpFailedSegmentTimeout: 500,
                            simultaneousP2PDownloads: 20,
                            simultaneousHttpDownloads: 2,
                            // httpDownloadInitialTimeout: 12e4,
                            // httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpDownloadInitialTimeout: 0,
                            httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpUseRanges: !0,
                            maxBufferLength: 300,
                            // useP2P: false,
                        },
                    };
                    // if (Hls.isSupported() && p2pml.hlsjs.Engine.isSupported()) {
                    //     var engine = new p2pml.hlsjs.Engine(engine_config);
                    //     player.setup(objSetup);
                    //     jwplayer_hls_provider.attach();
                    //     p2pml.hlsjs.initJwPlayer(player, {
                    //         liveSyncDurationCount: segments_in_queue, // To have at least 7 segments in queue
                    //         maxBufferLength: 300,
                    //         loader: engine.createLoaderClass(),
                    //     });
                    // } else {
                    player.setup(objSetup);
                    // }
                } else {
                    player.setup(objSetup);
                }

                player.addButton(
                    '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-rewind2" viewBox="0 0 240 240" focusable="false"><path d="m 25.993957,57.778 v 125.3 c 0.03604,2.63589 2.164107,4.76396 4.8,4.8 h 62.7 v -19.3 h -48.2 v -96.4 H 160.99396 v 19.3 c 0,5.3 3.6,7.2 8,4.3 l 41.8,-27.9 c 2.93574,-1.480087 4.13843,-5.04363 2.7,-8 -0.57502,-1.174985 -1.52502,-2.124979 -2.7,-2.7 l -41.8,-27.9 c -4.4,-2.9 -8,-1 -8,4.3 v 19.3 H 30.893957 c -2.689569,0.03972 -4.860275,2.210431 -4.9,4.9 z m 163.422413,73.04577 c -3.72072,-6.30626 -10.38421,-10.29683 -17.7,-10.6 -7.31579,0.30317 -13.97928,4.29374 -17.7,10.6 -8.60009,14.23525 -8.60009,32.06475 0,46.3 3.72072,6.30626 10.38421,10.29683 17.7,10.6 7.31579,-0.30317 13.97928,-4.29374 17.7,-10.6 8.60009,-14.23525 8.60009,-32.06475 0,-46.3 z m -17.7,47.2 c -7.8,0 -14.4,-11 -14.4,-24.1 0,-13.1 6.6,-24.1 14.4,-24.1 7.8,0 14.4,11 14.4,24.1 0,13.1 -6.5,24.1 -14.4,24.1 z m -47.77056,9.72863 v -51 l -4.8,4.8 -6.8,-6.8 13,-12.99999 c 3.02543,-3.03598 8.21053,-0.88605 8.2,3.4 v 62.69999 z"></path></svg>',
                    "Forward 10 Seconds", () => player.seek(player.getPosition() + 10), "Forward 10 Seconds");
                player.addButton(
                    '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-rewind" viewBox="0 0 240 240" focusable="false"><path d="M113.2,131.078a21.589,21.589,0,0,0-17.7-10.6,21.589,21.589,0,0,0-17.7,10.6,44.769,44.769,0,0,0,0,46.3,21.589,21.589,0,0,0,17.7,10.6,21.589,21.589,0,0,0,17.7-10.6,44.769,44.769,0,0,0,0-46.3Zm-17.7,47.2c-7.8,0-14.4-11-14.4-24.1s6.6-24.1,14.4-24.1,14.4,11,14.4,24.1S103.4,178.278,95.5,178.278Zm-43.4,9.7v-51l-4.8,4.8-6.8-6.8,13-13a4.8,4.8,0,0,1,8.2,3.4v62.7l-9.6-.1Zm162-130.2v125.3a4.867,4.867,0,0,1-4.8,4.8H146.6v-19.3h48.2v-96.4H79.1v19.3c0,5.3-3.6,7.2-8,4.3l-41.8-27.9a6.013,6.013,0,0,1-2.7-8,5.887,5.887,0,0,1,2.7-2.7l41.8-27.9c4.4-2.9,8-1,8,4.3v19.3H209.2A4.974,4.974,0,0,1,214.1,57.778Z"></path></svg>',
                    "Rewind 10 Seconds", () => player.seek(player.getPosition() - 10), "Rewind 10 Seconds");

                const resumeData = 'OPCMS-PlayerPosition-' + id;

                player.on('ready', function() {
                    if (typeof(Storage) !== 'undefined') {
                        if (localStorage[resumeData] == '' || localStorage[resumeData] == 'undefined') {
                            console.log("No cookie for position found");
                            var currentPosition = 0;
                        } else {
                            if (localStorage[resumeData] == "null") {
                                localStorage[resumeData] = 0;
                            } else {
                                var currentPosition = localStorage[resumeData];
                            }
                            console.log("Position cookie found: " + localStorage[resumeData]);
                        }
                        player.once('play', function() {
                            console.log('Checking position cookie!');
                            console.log(Math.abs(player.getDuration() - currentPosition));
                            if (currentPosition > 180 && Math.abs(player.getDuration() - currentPosition) >
                                5) {
                                player.seek(currentPosition);
                            }
                        });
                        window.onunload = function() {
                            localStorage[resumeData] = player.getPosition();
                        }
                    } else {
                        console.log('Your browser is too old!');
                    }
                });

                player.on('complete', function() {
                    if (typeof(Storage) !== 'undefined') {
                        localStorage.removeItem(resumeData);
                    } else {
                        console.log('Your browser is too old!');
                    }
                })

                function formatSeconds(seconds) {
                    var date = new Date(1970, 0, 1);
                    date.setSeconds(seconds);
                    return date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
                }
            }
        }
    </script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css"
        integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"
        integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const episode = '{{ $episode->id }}';
            let playing = document.querySelector(`[data-id="${episode}"]`);
            if (playing) {
                playing.click();
                return;
            }

            const servers = document.getElementsByClassName('streaming-server');
            if (servers[0]) {
                servers[0].click();
            }
        });
    </script>
    <script>
        const ROUTE_REPORT_ERROR =
            '{{ route('episodes.report', ['movie' => $currentMovie->slug, 'episode' => $episode->slug, 'id' => $episode->id]) }}';
    </script>
    <script>
        $("#report_error").click(function() {
            if ($("#episode_error").css("display") != "block") {
                $("#episode_error").css("display", "block");
            } else {
                $("#episode_error").css("display", "none");
            }
        });
        $("input#error_send").click(function() {
            console.log(123);
            let error_message = $("input[name=error_message]").val();
            fetch(ROUTE_REPORT_ERROR, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({
                    message: error_message,
                }),
            });
            $.toast({
                heading: "Thông báo",
                text: "Phản hồi của bạn đã được gửi đi!",
                position: "bottom-right",
                icon: "info",
                loader: true,
                loaderBg: "#9EC600",
                bgColor: "#212121",
                textColor: "white",
            });
            $("#episode_error").remove();
        });

        function goToNextEpisode() {
            // Lấy URL hiện tại
            var currentUrl = window.location.href;

            // Tách số tập từ URL hiện tại
            var episodeNumber = currentUrl.match(/tap-(\d+)/)[1];

            // Tăng số tập lên 1 để chuyển đến tập tiếp theo
            var nextEpisodeNumber = parseInt(episodeNumber) + 1;

            // Tạo URL mới với số tập tiếp theo
            var nextUrl = currentUrl.replace(/tap-\d+/, 'tap-' + nextEpisodeNumber);

            // Chuyển đến URL tiếp theo
            window.location.href = nextUrl;
        }
    </script>
    <script>
        let searchBtn = document.getElementById("searchBox");



        let lists = document.getElementsByClassName("sort-list");
        // 		let list = document.getElementsByClassName("episodes")[0].getElementsByTagName("li");

        searchBtn.addEventListener("click", searchList);
        searchBox.addEventListener("keyup", searchList);


        function searchList() {

            let searchTerm = searchBox.value.toLowerCase();

            for (let j = 0; j < lists.length; j++) {

                list = lists[j].getElementsByTagName("li");


                for (let i = 0; i < list.length; i++) {
                    let item = list[i].getElementsByTagName('a')[0].innerHTML.toLowerCase();

                    if (item.indexOf(searchTerm) > -1) {
                        list[i].style.display = "";

                    } else {
                        list[i].style.display = "none";
                    }
                }
            }

        }
    </script>
@endpush
