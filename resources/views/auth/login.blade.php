{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

// --------------------------------------------------------------------------------- --}}

@extends('client.layout.shardClient')


@section('style')
    <link href="{{ asset($globalVariable .'assetsClinet') }}/css/login.css" rel="stylesheet">
@endsection


@section('content')
    <div class='container'>
        <div class='loginMasar'>

            <div class='top-line'>
                <p>Welcome To</p>
                <span class='line'></span>
            </div>

            <img src="{{ asset($globalVariable .'assetsClinet') }}/imgs/Masar-Social-media-ابيض--.png" />
            <span class='line'></span>
        </div>



        <!-- Form login -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="login">
                <div class="loginForm">
                    <div class="boxInput">
                        <div class="form-floating">
                            <input id="email" type="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror" name="email" required
                                autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="floatingInputGrid">Your Email</label>
                        </div>
                    </div>
                    <div class="boxInput">
                        <div class="form-floating">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="floatingInputGrid">Password</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class='btnLogin'>
                {{-- <a href="{{url('/interface')}}" >Login</a> --}}
                <button type="submit" class="login">
                    {{ __('Login') }}
                </button>
            </div>
            <!-- End Form login -->


    </div>
@endsection




@section('script')
    <script src="{{ asset($globalVariable .'assetsClinet') }}/js/login.js"></script>
@endsection
