@extends('layouts.master', ['title' => 'Nouveau Post'])

@section('header')
	@include('shared._header')
@stop

@section('content')
	<div class="container">
		<h2>Création de Post</h2>
		{!! Form::open(['route' => 'admin.store', 'files' => true, 'method' => 'POST']) !!}
	
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			
			<div class="form-group">
				{!! Form::label('picture', 'Image du post') !!}
				{!! Form::file('picture', ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('post_type', 'Type') !!}
				{!! Form::select('post_type', ['formation' => 'Formation', 'stage' => 'Stage'], old('post_type'), ['required', 'placeholder' => 'Choix du type...', 'class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('title', 'Titre') !!}
				{!! Form::text('title', old('title'), ['required', 'placeholder' => 'Titre', 'class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('description', 'Description') !!}
				{!! Form::textarea('description', old('description'), ['required', 'placeholder' => 'Description', 'class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('start_date', 'Date de début') !!}
				{!! Form::date('start_date', \Carbon\Carbon::now(), ['required', 'class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('end_date', 'Date de fin') !!}
				{!! Form::date('end_date', \Carbon\Carbon::now(), ['required', 'class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('price', 'Prix') !!}
				{!! Form::text('price', old('price'), ['required', 'class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('max_students', 'Nombre d\'étudients maximum') !!}
				{!! Form::number('max_students', old('max_students'), ['required', 'class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('category_id', 'Catégorie') !!}
				{!! Form::select('category_id', $categories, old('category'), ['required', 'placeholder' => 'Choix de catégorie...', 'class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('published', 'Publier ?') !!}
				{!! Form::checkbox('published', null, old('published'), ['class' => 'form-control']) !!}
			</div>

			{!! Form::submit('Valider', ['class' => 'btn btn-primary']) !!}
			
		{!! Form::close() !!}
	</div>
@stop

@section('footer')
	@include('shared._footer')
@stop