<div class="relative">
    <section class="bg-slate-900 before:content-[''] before:absolute before:w-full before:h-full before:top-0 before:left-0 before:bg-gradient-to-br before:z-30 before:from-[#4150A2] before:from-10% before:to-transparent before:to-40% after:content-[''] after:absolute after:w-full after:h-full after:top-0 after:left-0 after:bg-gradient-to-tl  after:z-30 after:from-[#4150A2] after:to-transparent after:from-10% after:to-40% relative">
        <img src="{{ asset('images/style-left.svg') }}" class="absolute z-30" alt="">
        <img src="{{ asset('images/style-right.svg') }}" class="absolute z-30 right-0 bottom-0 hidden md:block" alt="">
        <div class="justify-center items-center flex container h-[1100px] flex-col relative z-40">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl text-slate-100 font-bold uppercase tracking-wider rtl:tracking-normal">{{ __('hackathon.title') }}</h1>
                <h2 class="text-2xl md:text-4xl text-slate-100 tracking-wider capitalize mt-10  rtl:tracking-normal">{{ __('hackathon.subtitle') }}</h2>
            </div>
            <div class="bg-transparent border border-white/70 z-40 shadow-[inset_0px_0px_5px_5px_rgba(255,_255,_255,_0.1)] grid grid-cols-2 md:flex flex-col md:flex-row justify-between mt-10 p-5 space-x-8 rtl:space-x-reverse rounded-xl">
                <div class="flex flex-col justify-center items-center text-white space-y-5 p-5 bg-purple-700 rounded-xl">
                    <h1 class="text-2xl md:text-3xl text-slate-300">{{ __('hackathon.days') }}</h1>
                    <h4 id="days" class="text-5xl md:text-7xl font-bold">10</h4>
                </div>
                <div class="flex flex-col justify-center items-center text-white space-y-5 p-5 rounded-lg">
                    <h1 class="text-2xl md:text-3xl text-slate-300">{{ __('hackathon.hours') }}</h1>
                    <h4 id="hours" class="text-5xl md:text-7xl font-bold">12</h4>
                </div>
                <div class="flex flex-col justify-center items-center text-white space-y-5 p-5 rounded-lg">
                    <h1 class="text-2xl md:text-3xl text-slate-300">{{ __('hackathon.minutes') }}</h1>
                    <h4 id="minutes" class="text-5xl md:text-7xl font-bold">14</h4>
                </div>
                <div class="flex flex-col justify-center items-center text-white space-y-5 p-5 rounded-lg">
                    <h1 class="text-2xl md:text-3xl text-slate-300">{{ __('hackathon.seconds') }}</h1>
                    <h4 id="seconds" class="text-5xl md:text-7xl font-bold">60</h4>
                </div>
            </div>
            <h3 class="text-2xl text-white mt-7 text-lg z-40">{{ __('hackathon.countdown_label') }}</h3>
            <div class="mt-16 z-50 relative">
                <h1 class="text-white mb-5 text-center font-bold z-40">{{ __('hackathon.participants_title') }}</h1>
                <div class="flex justify-center items-center gap-5 z-50 relative">
                    <div class="flex-col flex justify-center items-center ">
                        @svg('hugeicons-building-03', 'w-14 h-14  text-white')
                        <h1 class="text-white text-lg">{{ __('hackathon.companies') }}</h1>
                        <h1 class="text-5xl font-bold text-white">50</h1>
                    </div>
                    <div class="flex-col flex justify-center items-center ">
                        @svg('hugeicons-user-group', 'w-14 h-14  text-white')
                        <h1 class="text-white text-lg">{{ __('hackathon.individuals') }}</h1>
                        <h1 class="text-5xl font-bold text-white">20</h1>
                    </div>
                </div>
            </div>

        </div>
        <div class="w-full h-1/2 absolute -bottom-1 left-0 bg-gradient-to-t from-slate-900 from-5% to-transparent z-[34]"></div>
    </section>

    <section class="mt-56">
        <div class="container">
            <div class="flex justify-between items-center">
                <h1 class="text-4xl text-slate-100 font-bold text-center uppercase">{{ __('hackathon.challenges.title') }}</h1>
                <a href="{{ route('challenges.index') }}" class="bg-slate-100 px-6 py-5 rounded font-bold uppercase">{{ __('hackathon.challenges.see_all') }}</a>
            </div>
            <div class="grid grid-cols-1 md:col-span-3 gap-10 mt-20">
                @foreach($challenges as $challenge)
                    <a href="{{ route('challenges.show', ['challenge' => $challenge]) }}" class="bg-[#6D33D1] rounded-lg relative border-slate-400/50 border inline-block">
                        <div class="w-full h-[400px] rounded-t-lg" style="background: url('/storage/{{ $challenge->image }}'); background-size:  cover; background-position: center center;"></div>
                        <div class="z-30 relative p-5">
                            <h1 class="text-2xl text-white font-bold mb-3">{{ $challenge->title }}</h1>
                            <div class="flex space-x-3 rtl:space-x-reverse mb-3">
                                <div class="flex items-center space-x-2 text-white rtl:space-x-reverse">
                                    @svg('hugeicons-money-04', 'text-white w-5 h-5 mr-2 rtl:mr-0 rtl:ml-2')
                                    {{ $challenge->prize }} OMR
                                </div>
                                <div class="flex items-center space-x-2 rtl:space-x-reverse text-white">
                                    @svg('hugeicons-user-group', 'text-white w-5 h-5 mr-2 rtl:mr-0 rtl:ml-2')
                                    50 {{ __('hackathon.challenges.participants') }}
                                </div>
                            </div>
                            <p class="text-white/60">{{ Str::limit(strip_tags($challenge->description), 100) }}</p>
                        </div>
                        <div class="bg-purple-700 text-white absolute top-5 right-5 px-3 py-2 rounded flex items-center">
                            @svg('hugeicons-tags', 'w-5 h-5 text-white mr-2')
                            {{ $challenge->category->name }}
                        </div>
                        <div class="absolute bottom-0 left-0 bg-gradient-to-t from-slate-900 to-transparent w-full h-full z-10 rounded-b-lg"></div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mt-56">
        <div class="container">
            <div class="flex justify-between items-center">
                <h1 class="text-4xl text-slate-100 font-bold text-center uppercase"> {{ __('hackathon.speakers.title') }}</h1>
                <a href="{{ route('filament.user.auth.login') }}" class="bg-slate-100 px-6 py-5 rounded font-bold uppercase"> {{ __('hackathon.speakers.see_all') }}</a>
            </div>
{{--            <div class="grid grid-cols-3 gap-10 mt-40">--}}
{{--                <a href="#" class="inline-block">--}}
{{--                   <div class="bg-[#00A29A] rounded-lg relative border-slate-400/50  ">--}}
{{--                       <div class="w-full h-[300px] rounded-t-lg flex justify-center items-center">--}}
{{--                           <img src="{{ asset('images/aziz.png') }}" class="grayscale rounded-b-xl absolute bottom-0 left-1/2 -translate-x-1/2" width="300"  alt="">--}}
{{--                       </div>--}}
{{--                   </div>--}}
{{--                    <div class="z-30 relative mt-5">--}}
{{--                        <h1 class="text-2xl text-white font-bold mb-2">Mohammed Hamad</h1>--}}
{{--                        <p class="text-white/60">Full Stack web developer</p>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--                <a href="#" class="inline-block">--}}
{{--                    <div class="bg-[#00A29A] rounded-lg relative border-slate-400/50  ">--}}
{{--                        <div class="w-full h-[300px] rounded-t-lg flex justify-center items-center">--}}
{{--                            <img src="{{ asset('images/aziz.png') }}" class="grayscale rounded-b-xl absolute bottom-0 left-1/2 -translate-x-1/2" width="300"  alt="">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="z-30 relative mt-5">--}}
{{--                        <h1 class="text-2xl text-white font-bold mb-2">Mohammed Hamad</h1>--}}
{{--                        <p class="text-white/60">Full Stack web developer</p>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--                <a href="#" class="inline-block">--}}
{{--                    <div class="bg-[#00A29A] rounded-lg relative border-slate-400/50  ">--}}
{{--                        <div class="w-full h-[300px] rounded-t-lg flex justify-center items-center">--}}
{{--                            <img src="{{ asset('images/aziz.png') }}" class="grayscale rounded-b-xl absolute bottom-0 left-1/2 -translate-x-1/2" width="300"  alt="">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="z-30 relative mt-5">--}}
{{--                        <h1 class="text-2xl text-white font-bold mb-2">Mohammed Hamad</h1>--}}
{{--                        <p class="text-white/60">Full Stack web developer</p>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}
        </div>
    </section>
</div>
@push('scripts')
    <script>
        // Set your target date here
        const targetDate = new Date("2025-07-21T10:00:00").getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance < 0) {
                document.getElementById("days").innerText = "0";
                document.getElementById("hours").innerText = "0";
                document.getElementById("minutes").innerText = "0";
                document.getElementById("seconds").innerText = "0";
                clearInterval(interval);
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerText = days;
            document.getElementById("hours").innerText = String(hours).padStart(2, '0');
            document.getElementById("minutes").innerText = String(minutes).padStart(2, '0');
            document.getElementById("seconds").innerText = String(seconds).padStart(2, '0');
        }

        const interval = setInterval(updateCountdown, 1000);
        updateCountdown(); // run immediately
    </script>
@endpush
