@extends('layouts.master', ['title' => 'Home'])

@section('header')
	@include('shared._header')
@stop

@section('content')

	<div class="container">
		<div class="row">

			<section class="col-xs-12 col-md-8">
				<div class="container">
					<h2>Nos derniers évènements</h2>
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
						<p>Désolé, il n'y a pas de formation ou de stage disponible.</p>
					@endforelse

					@if(method_exists($posts, 'links'))
						{{ $posts->links() }}
					@endif
				</div>
			</section>

			<section class="col-xs-12 col-md-4">
				<div class="container">
					{!! Form::open(['route' => 'search', 'class' => 'form-inline my-2 my-lg-0', 'method' => 'POST']) !!}
						{!! Form::text('search', null, ['required', 'class' => 'form-control mr-sm-2']) !!}
    					{!! Form::submit('Rechercher', ['class' => 'btn btn-default my-2 my-sm-0']) !!}
					{!! Form::close() !!}
				</div>
			</section>

		</div>
	</div>
	
@stop

@section('footer')
	@include('shared._footer')
@stop