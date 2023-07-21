<!doctype html>
<html lang="ar" dir='rtl'>
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> @if (App::getLocale() == 'en') {{$setting['site_name_en'] ?? ''}} @elseif (App::getLocale() == 'ar') {{$setting['site_name_ar'] ?? ''}}@endif </title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400&display=swap" rel="stylesheet">


        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">
           <link href='{{asset("assets/css/bootstrap.min.css") }}'  rel="stylesheet" />
        <link href='{{asset("assets/css/owl.carousel.min.css") }}'  rel="stylesheet" />
        <link href='{{asset("assets/css/main.css") }}'  rel="stylesheet" />
           @stack('css')
    </head>
  <body>


  <header class='header'>
    <div class='container'>
        <div class='row align-items-center justify-content-between'>
            <div class='col-2'>
                <a href="{{route('index')}}" class='logo'>
                    @php $logo_url =  $setting['site_logo'] ?? '' ; @endphp
                    <img alt="Logo" src="{{$logo = asset('storage/uploads/setting') . '/' . $logo_url}}" class="h-45px h-lg-70px" />
                </a>
                </div>
                {{-- <a href="#" class='logo'>
                    <img  src="{{ asset('storage/uploads/setting' . '/' . $setting['site_logo'] ) ?? ''}}" >
                     </a> --}}
                     <div class='col-2'>
                        <div class="menu py-3 menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold " data-kt-menu="true">
                            <select onchange="window.location.href=this.value" class="form-select-solid form-select-sm">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <option value="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" {{ app()->getLocale() == $localeCode ? 'selected' : '' }}>
                                        {{ $properties['native'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                     </div>
            <div class='col-6'>
                <nav class='menu text-center'>
                    <ul class='list-inline m-0'>
                        @php
                       $headers = App\Models\Header::where('place','header')->paginate();

                        @endphp
                        @foreach ($headers as $header )

                        @php

                        $url = $header->url;
                        $lastWord = \Str::of($url)->afterLast('/');
                        @endphp
                               @if( $lastWord == 'ar')
                               <li class="list-inline-item mx-0 mx-md-2"> <a href="/" class='text-white text-decoration-none'> {{ $header->name }}   </a> </li>
                               @else
                               <li class="list-inline-item mx-0 mx-md-2"> <a href="{{$lastWord}}" class='text-white text-decoration-none'> {{ $header->name }}   </a> </li>

                               @endif
                        @endforeach

                    </ul>
                </nav>
            </div>
            <div class='col-2 text-end '>
                @if (Auth::check()) {{-- Show account dropdown --}}


                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="accountDropdown" data-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown" id="dropdown" >
                        <a class="dropdown-item" href="{{route('profile')}}">{{trans('home.profile')}}</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">{{trans('home.logout')}}</a>

                        </form>
                    </div>
                </div>
                @else
                    {{-- Show login link --}}
                    <a href="{{ route('login') }}" class='btn btn-outline-light rounded-pill d-inline-flex align-items-center'>
                        <span class='me-1'>   {{  trans('home.login')  }}      </span>
                        <svg width="16" height="18" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M9.00033 11.6667C13.5247 11.6667 17.2069 15.2723 17.3305 19.7668L17.3337 20H15.667C15.667 16.3181 12.6822 13.3334 9.00033 13.3334C5.3879 13.3334 2.44654 16.2066 2.33683 19.7924L2.33366 20H0.666992C0.666992 15.3977 4.39795 11.6667 9.00033 11.6667ZM9.00033 0.833374C11.7617 0.833374 14.0003 3.07195 14.0003 5.83337C14.0003 8.5948 11.7617 10.8334 9.00033 10.8334C6.2389 10.8334 4.00033 8.5948 4.00033 5.83337C4.00033 3.07195 6.2389 0.833374 9.00033 0.833374ZM9.00033 2.50004C7.15938 2.50004 5.66699 3.99242 5.66699 5.83337C5.66699 7.67432 7.15938 9.16671 9.00033 9.16671C10.8413 9.16671 12.3337 7.67432 12.3337 5.83337C12.3337 3.99242 10.8413 2.50004 9.00033 2.50004Z" fill="white"/> </svg>
                    </a>
                @endif

            </div>
        </div>
    </div>
  </header>

