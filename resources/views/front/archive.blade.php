@extends('layouts.master', ['title' => $title])

@section('header')
	@include('shared._header')
@stop

@section('content')

	<section class="container">
		@if($title == 'Formations')
			<h2>Nos dernières formations</h2>
		@else
			<h2>Nos derniers stages</h2>
		@endif
		@forelse($posts as $post)
			<div class="card">
				<div class="row no-gutters">
					<div class="col-auto">
						<img src="{{ asset('storage/' . $post->picture->link) }}" alt="{{ $post->title }}" class="img-fluid">
					</div>
					<div class="col">
						<div class="card-block px-2">
							<h5 class="card-title">{{ $post->title }}</h5>
							<p class="card-text">{{ $post->description }}</p>
							<a href="#" class="btn btn-primary">> Voir détail</a>
						</div>
					</div>
				</div>
		        <div class="card-footer w-100 text-muted">
		            Du {{ $post->start_date }} au {{ $post->end_date }}
		        </div>
			</div>
		@empty
			@if($title == 'Formations')
				<p>Désolé, il n'y a pas de formation disponible.</p>
			@else
				<p>Désolé, il n'y a pas de stage disponible.</p>
			@endif
		@endforelse

		{{ $posts->links() }}
	</section>
	
@stop

@section('footer')
	@include('shared._footer')
@stop