@extends('layouts.master', ['title' => __('Home')])

@section('header')
	@include('shared._header')
@stop

@section('content')

	<div class="container">
		@if(session('message'))
			<div class="alert alert-danger">
				<p>{{ session('message') }}</p>
			</div>
		@endif
		<div class="row">

			<section class="col-xs-12 col-md-8">
				<div class="container">
					<h2>{{ __('Our last events') }}</h2>
					@forelse($posts as $post)
						<div class="card">
							<div class="row no-gutters">
								<div class="col-auto">
									@if($post->picture()->exists())
										<img src="{{ asset('storage/' . $post->picture->link) }}" alt="{{ $post->title }}" class="img-fluid">
									@else
										<img src="{{ asset('img/default.png') }}" alt="{{ __('Unavailable picture') }}" class="img-fluid">
									@endif
								</div>
								<div class="col">
									<div class="card-block px-2">
										<h5 class="card-title">{{ $post->title }}</h5>
										<h6 class="card-subtitle mb-2 text-muted">{{ $post->category->title }}</h6>
										<p class="card-text">{{ $post->description }}</p>
										<a href="{{ url('post', $post->id) }}" class="btn btn-primary">> {{ __('See details') }}</a>
									</div>
								</div>
							</div>
					        <div class="card-footer w-100 text-muted">
					            {{ __('From') }} {{ $post->start_date }} {{ __('to') }} {{ $post->end_date }}
					        </div>
						</div>
					@empty
						<p>{{ __('Sorry, there is no event available for now.') }}</p>
					@endforelse

					@if(method_exists($posts, 'links'))
						{{ $posts->links() }}
					@endif
				</div>
			</section>

			<section class="col-xs-12 col-md-4">
				<div class="container">
					{!! Form::open(['route' => 'search', 'class' => 'form-inline', 'method' => 'POST']) !!}
						{!! Form::text('search', null, ['required', 'class' => 'form-control mr-sm-2']) !!}
    					{!! Form::submit(__('Search'), ['class' => 'btn btn-default']) !!}
					{!! Form::close() !!}
				</div>
			</section>

		</div>
	</div>
	
@stop

@section('footer')
	@include('shared._footer')
@stop