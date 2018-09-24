@extends('layouts.master', ['title' => 'Contact'])

@section('header')
	@include('shared._header')
@stop

@section('content')

	<div class="container">
		<h2>Désolé, cette page n'existe pas.</h2>
		<br>
		<a href="{{ url('/') }}" class="btn btn-primary">Retour à l'accueil</a>
	</div>
	
@stop

@section('footer')
	@include('shared._footer')
@stop