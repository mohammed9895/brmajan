<div>
    <div class="pt-56 text-center">
        <h1 class="text-6xl uppercase text-white font-bold"> {{ __('hackathon.challenges.section_title') }}</h1>
    </div>

    <div class="container mx-auto mt-32 lg:mt-56">
        <div class="flex w-full rounded-lg transition p-1 bg-slate-700">
            <nav class="flex justify-between items-center p-1 w-full" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                @foreach($challenge_categories as $category)
                    <button type="button" class="flex items-center justify-center text-white text-center w-full hover:bg-slate-600 hover:text-white p-2 rounded-md" wire:click="setCategory({{ $category->id }})" >
                        {{ $category->name }}
                    </button>
                @endforeach
            </nav>
        </div>
    </div>
    <div class="container mt-10">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4">
            @foreach($this->challenges as $challenge)
                <a href="{{ route('challenges.show', ['challenge' => $challenge]) }}" class="bg-[#6D33D1] rounded-lg relative border-slate-400/50 border inline-block">
                    <div class="w-full h-[400px] rounded-t-lg" style="background: url('/storage/{{ $challenge->image }}'); background-size:  cover; background-position: center center;"></div>
                    <div class="z-30 relative p-5">
                        <h1 class="text-2xl text-white font-bold mb-3">{{ $challenge->title }}</h1>
                        <div class="flex space-x-3 mb-3">
                            <div class="flex items-center space-x-2 text-white">
                                @svg('hugeicons-money-04', 'text-white w-5 h-5 mr-2')
                                {{ $challenge->prize }} OMR
                            </div>
                            <div class="flex items-center space-x-2 text-white">
                                @svg('hugeicons-user-group', 'text-white w-5 h-5 mr-2')
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
</div>
