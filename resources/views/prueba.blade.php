@extends('layouts.app')

@section('content')
    @guest
     <h1>NO TE CONOZCO SOS INVITADO</h1>
    @endguest

    @auth
     <h1> BIENVENIDO {{ Auth::user()->name }} !!!</h1>
    @endauth

@endsection
