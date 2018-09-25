@extends('layouts.master', ['title' => 'Panneau d\'administration'])

@section('header')
	@include('shared._header')
@stop

@section('content')
	<div class="container-fluid admin">
		@if(session('message'))
			<div class="alert alert-success">
				{{ session('message') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}">
				    <span aria-hidden="true">&times;</span>
				</button>
			</div>
		@endif

		<div class="row">
			<div class="col-md-2 col-12">
				<a href="{{ route('admin.create') }}" class="btn btn-primary">Créer un post</a>
			</div>
			<div class="col-md-4 col-12">
				{{ $posts->links() }}
			</div>
			<div class="col-md-6 col-12">
				{!! Form::open(['route' => 'searchadmin', 'class' => 'row float-right', 'method' => 'POST']) !!}
					{!! Form::text('search', null, ['required', 'class' => 'form-control col-8', 'placeholder' => __('Search')]) !!}
					<button type="submit" class="btn btn-default col-4">
						<span class="oi oi-magnifying-glass" title="{{ __('Search') }}" aria-hidden="true"></span>
					</button>
				{!! Form::close() !!}
			</div>
		</div>
		
		<div class="table-responsive">
			<table class="table table-striped w-auto">
			  	<thead>
			    	<tr>
			      		<th scope="col">
			      			<div class="flex">
			      				<div class="label">
			      					ID
			      				</div>
			      				<div class="sort">
			      					{!! Form::open(['route' => 'searchadmin', 'class' => 'float-right', 'method' => 'POST']) !!}
			      						{!! Form::hidden('type', 'sort') !!}
			      						{!! Form::hidden('field', 'id') !!}
			      						{!! Form::hidden('direction', 'asc') !!}
										<button type="submit" class="icon">
											<span class="oi oi-caret-top" title="{{ __('Ascending order') }}" aria-hidden="true"></span>
										</button>
									{!! Form::close() !!}
									{!! Form::open(['route' => 'searchadmin', 'class' => 'float-right', 'method' => 'POST']) !!}
										{!! Form::hidden('type', 'sort') !!}
			      						{!! Form::hidden('field', 'id') !!}
			      						{!! Form::hidden('direction', 'desc') !!}
										<button type="submit" class="icon">
											<span class="oi oi-caret-bottom" title="{{ __('Descending order') }}" aria-hidden="true"></span>
										</button>
									{!! Form::close() !!}
			      				</div>
			      			</div>
			      		</th>
			      		<th scope="col">
							<div class="flex">
			      				<div class="label">
			      					Type
			      				</div>
			      				<div class="sort">
			      					{!! Form::open(['route' => 'searchadmin', 'class' => 'float-right', 'method' => 'POST']) !!}
			      						{!! Form::hidden('type', 'sort') !!}
			      						{!! Form::hidden('field', 'post_type') !!}
			      						{!! Form::hidden('direction', 'asc') !!}
										<button type="submit" class="icon">
											<span class="oi oi-caret-top" title="{{ __('Ascending order') }}" aria-hidden="true"></span>
										</button>
									{!! Form::close() !!}
									{!! Form::open(['route' => 'searchadmin', 'class' => 'float-right', 'method' => 'POST']) !!}
										{!! Form::hidden('type', 'sort') !!}
			      						{!! Form::hidden('field', 'post_type') !!}
			      						{!! Form::hidden('direction', 'desc') !!}
										<button type="submit" class="icon">
											<span class="oi oi-caret-bottom" title="{{ __('Descending order') }}" aria-hidden="true"></span>
										</button>
									{!! Form::close() !!}
			      				</div>
			      			</div>
			      		</th>
			      		<th scope="col">
			      			<div class="flex">
			      				<div class="label">
			      					Titre
			      				</div>
			      				<div class="sort">
			      					{!! Form::open(['route' => 'searchadmin', 'class' => 'float-right', 'method' => 'POST']) !!}
			      						{!! Form::hidden('type', 'sort') !!}
			      						{!! Form::hidden('field', 'title') !!}
			      						{!! Form::hidden('direction', 'asc') !!}
										<button type="submit" class="icon">
											<span class="oi oi-caret-top" title="{{ __('Ascending order') }}" aria-hidden="true"></span>
										</button>
									{!! Form::close() !!}
									{!! Form::open(['route' => 'searchadmin', 'class' => 'float-right', 'method' => 'POST']) !!}
										{!! Form::hidden('type', 'sort') !!}
			      						{!! Form::hidden('field', 'title') !!}
			      						{!! Form::hidden('direction', 'desc') !!}
										<button type="submit" class="icon">
											<span class="oi oi-caret-bottom" title="{{ __('Descending order') }}" aria-hidden="true"></span>
										</button>
									{!! Form::close() !!}
			      				</div>
			      			</div>
			      		</th>
			      		<th scope="col">
			      			<div class="flex">
			      				<div class="label">
			      					Début
			      				</div>
			      				<div class="sort">
			      					{!! Form::open(['route' => 'searchadmin', 'class' => 'float-right', 'method' => 'POST']) !!}
			      						{!! Form::hidden('type', 'sort') !!}
			      						{!! Form::hidden('field', 'start_date') !!}
			      						{!! Form::hidden('direction', 'asc') !!}
										<button type="submit" class="icon">
											<span class="oi oi-caret-top" title="{{ __('Ascending order') }}" aria-hidden="true"></span>
										</button>
									{!! Form::close() !!}
									{!! Form::open(['route' => 'searchadmin', 'class' => 'float-right', 'method' => 'POST']) !!}
										{!! Form::hidden('type', 'sort') !!}
			      						{!! Form::hidden('field', 'start_date') !!}
			      						{!! Form::hidden('direction', 'desc') !!}
										<button type="submit" class="icon">
											<span class="oi oi-caret-bottom" title="{{ __('Descending order') }}" aria-hidden="true"></span>
										</button>
									{!! Form::close() !!}
			      				</div>
			      			</div>
			      		</th>
			      		<th scope="col">
			      			<div class="flex">
			      				<div class="label">
			      					Fin
			      				</div>
			      				<div class="sort">
			      					{!! Form::open(['route' => 'searchadmin', 'class' => 'float-right', 'method' => 'POST']) !!}
			      						{!! Form::hidden('type', 'sort') !!}
			      						{!! Form::hidden('field', 'end_date') !!}
			      						{!! Form::hidden('direction', 'asc') !!}
										<button type="submit" class="icon">
											<span class="oi oi-caret-top" title="{{ __('Ascending order') }}" aria-hidden="true"></span>
										</button>
									{!! Form::close() !!}
									{!! Form::open(['route' => 'searchadmin', 'class' => 'float-right', 'method' => 'POST']) !!}
										{!! Form::hidden('type', 'sort') !!}
			      						{!! Form::hidden('field', 'end_date') !!}
			      						{!! Form::hidden('direction', 'desc') !!}
										<button type="submit" class="icon">
											<span class="oi oi-caret-bottom" title="{{ __('Descending order') }}" aria-hidden="true"></span>
										</button>
									{!! Form::close() !!}
			      				</div>
			      			</div>
			      		</th>
			      		<th scope="col">
							<div class="flex">
			      				<div class="label">
			      					Catégorie
			      				</div>
			      				<div class="sort">
			      					{!! Form::open(['route' => 'searchadmin', 'class' => 'float-right', 'method' => 'POST']) !!}
			      						{!! Form::hidden('type', 'sort') !!}
			      						{!! Form::hidden('field', 'category_id') !!}
			      						{!! Form::hidden('direction', 'asc') !!}
										<button type="submit" class="icon">
											<span class="oi oi-caret-top" title="{{ __('Ascending order') }}" aria-hidden="true"></span>
										</button>
									{!! Form::close() !!}
									{!! Form::open(['route' => 'searchadmin', 'class' => 'float-right', 'method' => 'POST']) !!}
										{!! Form::hidden('type', 'sort') !!}
			      						{!! Form::hidden('field', 'category_id') !!}
			      						{!! Form::hidden('direction', 'desc') !!}
										<button type="submit" class="icon">
											<span class="oi oi-caret-bottom" title="{{ __('Descending order') }}" aria-hidden="true"></span>
										</button>
									{!! Form::close() !!}
			      				</div>
			      			</div>
			      		</th>
			      		<th scope="col">
							<div class="flex">
			      				<div class="label">
			      					Publié
			      				</div>
			      				<div class="sort">
			      					{!! Form::open(['route' => 'searchadmin', 'class' => 'float-right', 'method' => 'POST']) !!}
			      						{!! Form::hidden('type', 'sort') !!}
			      						{!! Form::hidden('field', 'status') !!}
			      						{!! Form::hidden('direction', 'asc') !!}
										<button type="submit" class="icon">
											<span class="oi oi-caret-top" title="{{ __('Ascending order') }}" aria-hidden="true"></span>
										</button>
									{!! Form::close() !!}
									{!! Form::open(['route' => 'searchadmin', 'class' => 'float-right', 'method' => 'POST']) !!}
										{!! Form::hidden('type', 'sort') !!}
			      						{!! Form::hidden('field', 'status') !!}
			      						{!! Form::hidden('direction', 'desc') !!}
										<button type="submit" class="icon">
											<span class="oi oi-caret-bottom" title="{{ __('Descending order') }}" aria-hidden="true"></span>
										</button>
									{!! Form::close() !!}
			      				</div>
			      			</div>
			      		</th>
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
							<td>{{ $post->category->title }}</td>
							<td>{{ ($post->status == 'published') ? 'Oui' : 'Non' }}</td>
							<td class="flex">
								<a href="{{ route('admin.edit', $post->id) }}"><span class="oi oi-wrench" title="Modifier" aria-hidden="true"></span></a>
								<a href="#" onclick="openModal(event, 'del', {{ $post->id }});"><span class="oi oi-trash" title="Supprimer" aria-hidden="true"></span></a>
								@if($post->status == 'draft')
									<a href="#" onclick="openModal(event, 'pub', {{ $post->id }});"><span class="oi oi-plus" title="Publier" aria-hidden="true"></span></a>
								@elseif($post->status == 'published')
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
							<td>Total : {{ $posts->total() }} posts</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
		
		<div class="row">
			<div class="col-4">
				{{ $posts->links() }}
			</div>
			@if($posts->count() > 1)
				<div class="col-8">
					<div class="form-inline float-right">
						<select id="grouped_actions" class="form-control mr-sm-2" required>
							<option disabled selected>Choix de l'action...</option>
							<option value="soft" disabled>Déplacer à la corbeille</option>
							<option value="del">Supprimer</option>
						</select>
						<button onclick="openModal(event, 'actions', {{ $post->id }});" class="btn btn-default mr-sm-2">Valider</button>
						<div onclick="checkAll();"><button class="btn btn-primary" id="checkall">Tout cocher</button></div>
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