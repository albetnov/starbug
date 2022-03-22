@include('layouts.header')
@if (Auth::user()->role != 'disabled')
    @include('layouts.navbar')
    @include('layouts.topbar')
@endif
@yield('content')
@include('layouts.footer')
