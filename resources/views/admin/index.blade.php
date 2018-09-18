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
		<a href="{{ route('admin.create') }}" class="btn btn-primary">Créer un post</a>
		<table class="table">
		  	<thead>
		    	<tr>
		      		<th scope="col">ID</th>
		      		<th scope="col">Type</th>
		      		<th scope="col">Titre</th>
		      		<th scope="col">Date de début</th>
		      		<th scope="col">Date de fin</th>
		      		<th scope="col">Prix</th>
		      		<th scope="col">Etudients</th>
		      		<th scope="col">Catégorie</th>
		      		<th scope="col">Publié</th>
		      		<th scope="col"></th>
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
						<td>{{ $post->price }} €</td>
						<td>{{ $post->max_students }}</td>
						<td>{{ $post->category->title }}</td>
						<td>{{ ($post->published) ? 'Oui' : 'Non' }}</td>
						<td>
							<a href="{{ route('admin.edit', $post->id) }}"><span class="oi oi-wrench" title="Modifier" aria-hidden="true"></span></a>
							<a href="#"><span class="oi oi-trash" title="Supprimer" aria-hidden="true"></span></a>
							@if(!$post->published)
								<a href="#"><span class="oi oi-plus" title="Publier" aria-hidden="true"></span></a>
							@else
								<a href="#"><span class="oi oi-ban" title="Enlever publication" aria-hidden="true"></span></a>
							@endif
						</td>
					</tr>
				@empty
					<tr>
						<th scope="row">#</th>
						<td>Désolé, il n'y a pas de stage disponible.</td>
					</tr>
				@endforelse
			</tbody>
		</table>

		{{ $posts->links() }}
	</div>
@stop

@section('footer')
	@include('shared._footer')
@stop