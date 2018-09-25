@extends('layouts.master', ['title' => $title])

@section('header')
	@include('shared._header')
@stop

@section('content')

	<section class="container single">
		<h2>{{ ucfirst($post->post_type) }} - {{ $post->title }}</h2>
		<hr>
		<br>
		<div class="row no-gutters">
			<div class="col-12 col-md-4">
				@if($post->picture()->exists())
					<img src="{{ asset('storage/' . $post->picture->link) }}" alt="{{ $post->title }}" class="img-fluid">
				@else
					<img src="{{ asset('img/default.png') }}" alt="Image indisponible" class="img-fluid">
				@endif
			</div>
			<div class="col-12 col-md-8">
				<p>{{ $post->description }}</p>
				<br>
				<p><strong>Catégorie :</strong> {{ $post->category->title }}</p>
				<p><strong>Date de début :</strong> {{ $post->start_date }}</p>
				<p><strong>Date de fin :</strong> {{ $post->end_date }}</p>
				<p><strong>Nombre maximum d'élèves :</strong> {{ $post->max_students }}</p>
				<p><strong>Prix :</strong> {{ $post->price }}€</p>
				<br>
				@if(auth()->user()) <a href="{{ url('/') }}" class="btn btn-primary">S'inscrire</a> @endif
			</div>
			<div class="col-12">
				<a href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
			</div>
		</div>
		
	</section>
	
@stop

@section('footer')
	@include('shared._footer')
@stop