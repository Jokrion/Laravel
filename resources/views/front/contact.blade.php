@extends('layouts.master', ['title' => 'Contact'])

@section('header')
	@include('shared._header')
@stop

@section('content')

	<div class="container">
		@if(!isset($sent))
			{!! Form::open(['route' => 'contact', 'method' => 'POST']) !!}
				<div class="form-group">
					@if ($errors->any())
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
				</div>
				<div class="form-group">
					{!! Form::label('email', 'Adresse Email :') !!}
					{!! Form::email('email', old('email'), ['required', 'class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('message', 'Votre message :') !!}
					{!! Form::textarea('message', old('message'), ['required', 'class' => 'form-control']) !!}
				</div>
				{!! Form::submit('Envoyer', ['class' => 'btn btn-primary']) !!}
			{!! Form::close() !!}
		@else
			<div class="text-center">
				<p>L'envoi de votre message a bien été effectué.</p>
				<a href="{{ url('/') }}" class="btn btn-primary">Retour à l'accueil</a>
			</div>
		@endif
	</div>
	
@stop

@section('footer')
	@include('shared._footer')
@stop