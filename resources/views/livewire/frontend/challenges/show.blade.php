<div>
    <section class="flex py-52 justify-center items-center  relative after:content[''] after:w-full after:h-full after:absolute after:bottom-0 after:left-0 after:bg-gradient-to-t after:from-slate-900 after:via-slate-900/90 after:to-transparent after:z-10" style="background: url('/storage/{{ $challenge->image }}'); background-size: cover; background-position: center;">
        <div class="text-center text-white max-w-6xl z-20">
            <div class="flex items-center justify-center mb-5">
                <div class="bg-purple-700 text-white px-3 py-2 rounded inline-flex items-center">
                    @svg('hugeicons-tags', 'w-5 h-5 text-white mr-2')
                    {{ $challenge->category->name }}
                </div>
                <div class="flex items-center space-x-2  px-3 py-2 text-white">
                    @svg('hugeicons-user-group', 'text-white w-5 h-5 mr-2')
                    {{ __('hackathon.challenges.participants', ['count' => $participated_count]) }}
                </div>
            </div>
            <h1 class="font-bold uppercase text-6xl leading-tight ">{{ $challenge->title }}</h1>
        </div>
    </section>
    <div class="container prose prose-lg prose-invert w-full">
        {!! $challenge->description !!}
    </div>

    @auth
        @if(!$participated)
            <div class="container dark max-w-6xl">
                <h1 class="text-slate-100 text-2xl mb-2 font-bold">{{ __('hackathon.challenges.participate_now') }}</h1>
                <p class="text-slate-100 mb-5">{{ __('hackathon.challenges.participate_hint') }}</p>
                {{ $this->form }}
                <x-filament::button wire:click="create" class="mt-3">
                    {{ __('hackathon.challenges.submit_button') }}
                </x-filament::button>
            </div>
        @else
            <div class="container  max-w-6xl">
                <div class="mt-2 bg-yellow-100 border flex border-yellow-200 text-sm text-yellow-800 rounded-lg p-4 dark:bg-yellow-800/10 dark:border-yellow-900 dark:text-yellow-500" role="alert" tabindex="-1" aria-labelledby="hs-soft-color-warning-label">
                    @svg('hugeicons-information-circle' , 'w-5 h-5 mr-2 rtl:ml-2 rtl:mr-0')
                    {{ __('hackathon.challenges.already_participated') }}
                </div>
            </div>
        @endif
    @endauth

    @guest
        <div class="container  max-w-6xl">
            <div class="mt-2 bg-yellow-100 border flex border-yellow-200 text-sm text-yellow-800 rounded-lg p-4 dark:bg-yellow-800/10 dark:border-yellow-900 dark:text-yellow-500" role="alert" tabindex="-1" aria-labelledby="hs-soft-color-warning-label">
                @svg('hugeicons-information-circle' , 'w-5 h-5 mr-2 rtl:ml-2 rtl:mr-0')
                {!! __('hackathon.challenges.guest_notice') !!}
            </div>
        </div>
    @endguest
</div>
