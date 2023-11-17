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
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <label for="floatingInputGrid">Your Email</label>
                    </div>
                    <div class="boxInput">
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
    <script src="{{ asset($globalVariable . 'assetsClinet') }}/js/login.js"></script>
@endsection
