@extends('layouts.master', ['title' => 'Panneau d\'administration'])

@section('header')
	@include('shared._header')
@stop

@section('content')
	<div class="container">
		@if(session('message'))
			<div class="alert alert-success">
				<p>{{ session('message') }}</p>
			</div>
		@endif

		<div class="row">
			<div class="col-lg-2 col-xs-12">
				<a href="{{ route('admin.create') }}" class="btn btn-primary">Créer un post</a>
			</div>
			<div class="col-lg-4 col-xs-12">
				{{ $posts->links() }}
			</div>
			<div class="col-lg-6 col-xs-12">
				{!! Form::open(['route' => 'searchadmin', 'class' => 'form-inline float-right', 'method' => 'POST']) !!}
					{!! Form::text('search', null, ['required', 'class' => 'form-control mr-sm-2']) !!}
					{!! Form::submit(__('Search'), ['class' => 'btn btn-default']) !!}
				{!! Form::close() !!}
			</div>
		</div>

		<table class="table">
		  	<thead>
		    	<tr>
		      		<th scope="col">ID</th>
		      		<th scope="col">Type</th>
		      		<th scope="col">Titre</th>
		      		<th scope="col">Début</th>
		      		<th scope="col">Fin</th>
		      		{{-- <th scope="col">Prix</th>
		      		<th scope="col">Etudients</th> --}}
		      		<th scope="col">Catégorie</th>
		      		<th scope="col">Publié</th>
		      		<th scope="col"></th>
		      		@if($posts->count() > 1) <th scope="col"></th> @endif
		    	</tr>
		  	</thead>
		  	<tbody>
				@forelse($posts as $post)
					<tr>
						<th scope="row">{{ $post->id }}</th>
						<td>{{ ($post->isFormation()) ? 'Formation' : 'Stage' }}</td>
						<td><a href="{{ route('admin.show', $post->id) }}">{{ $post->title }}</a></td>
						<td>{{ $post->start_date }}</td>
						<td>{{ $post->end_date }}</td>
						{{-- <td>{{ $post->price }} €</td>
						<td>{{ $post->max_students }}</td> --}}
						<td>{{ $post->category->title }}</td>
						<td>{{ ($post->published) ? 'Oui' : 'Non' }}</td>
						<td>
							<a href="{{ route('admin.edit', $post->id) }}"><span class="oi oi-wrench" title="Modifier" aria-hidden="true"></span></a>
							<a href="#" onclick="openModal(event, 'del', {{ $post->id }});"><span class="oi oi-trash" title="Supprimer" aria-hidden="true"></span></a>
							@if(!$post->published)
								<a href="#" onclick="openModal(event, 'pub', {{ $post->id }});"><span class="oi oi-plus" title="Publier" aria-hidden="true"></span></a>
							@else
								<a href="#" onclick="openModal(event, 'unpub', {{ $post->id }});"><span class="oi oi-ban" title="Enlever publication" aria-hidden="true"></span></a>
							@endif
						</td>
						@if($posts->count() > 1)
							<td>
								<input type="checkbox" onclick="check();" name="check_{{ $post->id }}">
							</td>
						@endif
					</tr>
				@empty
					<tr>
						<th scope="row">#</th>
						<td></td>
						<td>Désolé, il n'y a pas de stage disponible.</td>
					</tr>
				@endforelse
				@if(!empty($posts))
					<tr>
						<th scope="row">#</th>
						<td></td>
						<td>Total : {{ $posts->count() }} posts</td>
					</tr>
				@endif
			</tbody>
		</table>
		
		<div class="row">
			<div class="col-lg-4">
				{{ $posts->links() }}
			</div>
			@if($posts->count() > 1)
				<div class="col-lg-8">
					<div class="form-inline float-right">
						<select id="grouped_actions" class="form-control" required>
							<option disabled selected>Choix de l'action...</option>
							<option value="soft" disabled>Déplacer à la corbeille</option>
							<option value="del">Supprimer</option>
						</select>
						<button onclick="openModal(event, 'actions', {{ $post->id }});" class="btn btn-default">Valider</button>
						<div onclick="checkAll();"><a style="cursor: pointer;" id="checkall">Tout cocher</a></div>
					</div>
				</div>
			@endif
		</div>
	</div>

	<span style="display: none;" id="postid"></span>

	@include('admin.partials._modal', ['id' => 'deleteModal', 'text' => 'Êtes-vous sûr de vouloir supprimer ce post ?', 'method' => 'removePost', 'button_text' => 'Supprimer', 'args' => [csrf_token(), url('admin/#'), url('admin')]])

	@include('admin.partials._modal', ['id' => 'pubModal', 'text' => 'Êtes-vous sûr de vouloir publier ce post ?', 'method' => 'toggle', 'button_text' => 'Oui', 'args' => [url('admin/#/toggle'), url('admin')]])

	@include('admin.partials._modal', ['id' => 'unpubModal', 'text' => 'Êtes-vous sûr de vouloir enlever le statut publié de ce post ?', 'method' => 'toggle', 'button_text' => 'Oui', 'args' => [url('admin/#/toggle'), url('admin')]])

	@include('admin.partials._modal', ['id' => 'actionsModal', 'text' => 'Êtes-vous sûr de vouloir supprimer définitivement ces posts ?', 'method' => 'groupedAction', 'button_text' => 'Supprimer', 'args' => [url('/')]])

@stop

@section('footer')
	@include('shared._footer')
	<script src="{{ asset('js/admin.js') }}"></script>
@stop