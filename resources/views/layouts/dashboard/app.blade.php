@include('layouts.dashboard.header')

@include('layouts.dashboard.side_menu')

<main>
    <div class="container-fluid ">
        <div class="row">
            <div class="col-12">
                @yield('content')
            </div>
        </div>
    </div>
</main>

@include('layouts.dashboard.footer')