@extends('client.layout.shardClient')

@section('style')
    <link href="{{ asset($globalVariable . 'assetsClinet') }}/css/welcome.css" rel="stylesheet">
@endsection


@section('content')
<div class="welcome">
    <div class="loading">
        <div class="boxLogo">
            <img src="{{asset($globalVariable .'assetsClinet')}}/imgs/Masar-Social-media-ابيض--.png"/>
        </div>
        <div>
            <div id="loop" class="center"></div>
            <span class="lineStreet"></span>
            <div id="bike-wrapper" class="center">
            <div id="bike" class="centerBike"></div>
            </div>
        </div>
        <div class='btnStart'>
            <a href="{{ url('/client/login') }}" class="start">Start</a>
        </div>
    </div>
</div>

@endsection




@section('script')
    <script src="{{ asset($globalVariable . 'assetsClinet') }}/js/welcome.js"></script>
@endsection
