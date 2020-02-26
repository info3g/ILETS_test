@extends('default')
@section('content')
<div class="whole-section">
<div class="full-overlay-section">
    <div class="container">
        <div class="d-flex flex-column align-items-center overlay-sec  pt-5 pb-5">
            @include('menu.banner72890')
            <h1>Day of <span>Birth </span></h1>
            <h3>If you were born on a {{strtoupper($day)}} :</h3>
            <img class="pt-1 pb-4" src="{{asset('images/sep-purple.png')}}" alt="banner"/>
            <ul>
                @foreach(explode(" .", $answer) as $value)
                @if(!empty($value))
                <li>{{$value}}.</li>
                @endif
                @endforeach
            </ul>
            @include('menu.linkunit18090')
        </div>
    </div>
</div>
</div>
@endsection