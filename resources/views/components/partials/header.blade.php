<div class="w-full mx-auto z-50 absolute top-0 left-0" x-data="{ atTop: true, menuOpen: false }">
    <div class="flex justify-between  items-center container">
       <a href="/">
           <img src="{{ asset('images/logos.svg') }}" class="h-32" alt="">
       </a>
        <div class="flex justify-start items-center space-x-3 rtl:space-x-reverse">
            @if(session()->get('lang') == 'ar')
                <a href="{{ route('locale', 'en') }}"
                   class="inline-block uppercase text-gray-200 hover:text-white py-7 px-5 tracking-wider mr-3 rtl:ml-3 rtl:mr-0">EN</a>
            @else
                <a href="{{ route('locale', 'ar') }}"
                   class="inline-block uppercase text-gray-200 hover:text-white py-7 px-5 tracking-wider mr-3 rtl:ml-4 rtl:mr-0">AR</a>
            @endif
            <a href="{{ route('filament.user.auth.login') }}" class="bg-slate-100 px-6 py-5 rounded font-bold">{{ __('hackathon.nav.register') }}</a>
        </div>
    </div>
</div>
