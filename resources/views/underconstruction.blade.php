@extends('layouts.app')

<link rel="stylesheet" href="{{asset('css/bob.css')}}">
@section('content')
<h1> under construction </h1>
<img src="{{asset('img/bob.jpg')}}" atl="Bob De Bouwer">
<a href="{{ url('/broken') }}" class="hidden">Please don't click it isn't done yet</a>
@endsection