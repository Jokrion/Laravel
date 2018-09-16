@extends('layouts.master', ['title' => $title])

@section('header')
	@include('shared._header')
@stop

@section('content')

	<section class="container">
		<h2>{{ $post->title }}</h2>
		<hr>
		<div class="row no-gutters">
			<div class="col-xs-12 col-md-4">
				<img src="{{ asset('storage/' . $post->picture->link) }}" alt="{{ $post->title }}">
			</div>
			<div class="col-xs-12 col-md-8">
				<p>{{ $post->description }}</p>
			</div>
			<div class="col-xs-12 col-md-4">
				<p>Date de début : {{ $post->start_date }}</p>
				<p>Date de fin : {{ $post->end_date }}</p>
				<p>Nombre maximum d'élèves : {{ $post->max_students }}</p>
			</div>
		</div>
		
	</section>
	
@stop

@section('footer')
	@include('shared._footer')
@stop