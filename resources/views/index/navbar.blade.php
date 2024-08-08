<div class="pos-f-t">
    {{-- <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
            <h4 class="text-white">Collapsed content</h4>
            <span class="text-muted">Toggleable via the navbar brand.</span>
        </div>
    </div> --}}
    <nav class="navbar navbar-dark bg-gray-800 fixed-top">
        {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent"
                aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> --}}
        <a href="https://zone01oujda.ma/" class="zone-logo">
            <img src="{{ asset('images/zone_logo.png') }}" alt="Zone01 Oujda">
        </a>

        @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none  font-bold text-sm  focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Dashboard
                        <i class="fa-solid fa-table-columns ml-1"></i>
                    </a>
                @else
                    <a type="button" href="{{ route('login') }}"
                        class="text-white bg-[#050708] hover:bg-[#050708]/90 focus:ring-4 focus:outline-none focus:ring-[#050708]/50 font-bold rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#050708]/50 dark:hover:bg-[#050708]/30 me-2 mb-2">
                        Login
                        <i class="fa-solid fa-right-to-bracket ml-1"></i>
                    </a>
                @endauth
            </nav>
        @else
        @endif
    </nav>
</div>
