@extends('layouts.master', ['title' => 'Editer Post'])

@section('header')
	@include('shared._header')
@stop

@section('content')
	<div class="container form-admin">
		<h2>Edition d'événement'</h2>
		{!! Form::open(['route' => ['admin.update', $post->id], 'files' => true, 'method' => 'put']) !!}
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			        <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}">
					    <span aria-hidden="true">&times;</span>
					</button>
			    </div>
			@endif
			
			<div class="form-group">
				{!! Form::label('post_type', 'Type') !!}
				{!! Form::select('post_type', ['formation' => 'Formation', 'stage' => 'Stage'], (old('post_type') !== null) ? old('post_type') : $post->post_type, ['required', 'placeholder' => 'Choix du type...', 'class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('title', 'Titre') !!}
				{!! Form::text('title', (old('title') !== null) ? old('title') : $post->title, ['required', 'placeholder' => 'Titre', 'class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('description', 'Description') !!}
				{!! Form::textarea('description', (old('description') !== null) ? old('description') : $post->description, ['required', 'placeholder' => 'Description', 'class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('start_date', 'Date de début') !!}
				{!! Form::date('start_date', $post->start_date, ['required', 'class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('end_date', 'Date de fin') !!}
				{!! Form::date('end_date', $post->end_date, ['required', 'class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('price', 'Prix') !!}
				{!! Form::text('price', (old('price') !== null) ? old('price') : $post->price, ['required', 'class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('max_students', 'Nombre d\'étudients maximum') !!}
				{!! Form::number('max_students', (old('max_students') !== null) ? old('max_students') : $post->max_students, ['required', 'class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				<img src="{{ asset('storage/' . $post->picture->link) }}" alt="{{ $post->title }}" class="img-fluid">
			</div>
			<div class="form-group">
				{!! Form::label('picture', 'Image du post') !!}
				{!! Form::file('picture', ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('category_id', 'Catégorie') !!}
				{!! Form::select('category_id', $categories, (old('category') !== null) ? old('category') : $post->category->id, ['required', 'placeholder' => 'Choix de catégorie...', 'class' => 'form-control']) !!}
			</div>
			<div class="form-group check">
				{!! Form::label('status', 'Publier ?') !!}
				{!! Form::checkbox('status', null, (old('status') !== null) ? ((old('status') == 'published') ? true : false) : (($post->status == 'published') ? true : false), ['class' => 'form-control']) !!}
			</div>

			{!! Form::submit('Modifier', ['class' => 'btn btn-primary']) !!}
			
		{!! Form::close() !!}
	</div>
@stop

@section('footer')
	@include('shared._footer')
@stop