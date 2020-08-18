<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie edge">
    <title>@yield('title-block')</title>
    <!-- Styles-->
<!--   <link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
     <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

@include('inc.header')
@if(Request::is('/'))
@include('inc.hero')
@endif

<div class="container-mt-5">
    <div class="row">
        <div class="col-8">
            @yield('content')
        </div>
        <div class="col-4">
            @include('inc.aside')
        </div>
    </div>
</div>
<!-- Right Side Of Navbar -->
<ul class="navbar-nav ml-auto">
    @foreach (config('app.available_locales') as $locale)
        <li class="nav-item">
            <a class="nav-link"
               href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), $locale) }}"
               @if (app()->getLocale() == $locale) style="font-weight: bold; text-decoration: underline" @endif>{{ strtoupper($locale) }}</a>
        </li>
    @endforeach
@guest
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login', app()->getLocale()) }}">{{ __('Login') }}</a>
    </li>
    @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register', app()->getLocale()) }}">{{ __('Register') }}</a>
        </li>
    @endif
@else
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout', app()->getLocale()) }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
@endguest

@include('inc.footer')

<body>

</body>
</html>
