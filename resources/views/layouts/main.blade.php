@include('layouts.header')
@if (Auth::user()->role != 'disabled')
    @if (Auth::user()->role == 'owner')
        @include('layouts.navbar')
    @else
        @include('layouts.cashier.navbar')
    @endif
    @include('layouts.topbar')
@endif
@yield('content')
@include('layouts.footer')
