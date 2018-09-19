@extends('layouts.master', ['title' => $title])

@section('header')
	@include('shared._header')
@stop

@section('content')

	<section class="container">
		<h2>{{ $post->title }}</h2>
		<hr>
		<a href="{{ url('admin') }}" class="btn btn-primary">< Retour à la liste</a>
		<div class="row no-gutters">
			<div class="col-xs-12 col-md-4">
				@if($post->picture()->exists())
					<img src="{{ asset('storage/' . $post->picture->link) }}" alt="{{ $post->title }}" class="img-fluid">
				@else
					<img src="{{ asset('img/default.png') }}" alt="Image indisponible" class="img-fluid">
				@endif
			</div>
			<div class="col-xs-12 col-md-8">
				<p>{{ $post->description }}</p>
			</div>
			<div class="col-xs-12 col-md-4">
				<p>Catégorie : {{ $post->category->title }}</p>
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