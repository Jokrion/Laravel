@extends('layouts.master', ['title' => 'Home'])

@section('header')
	@include('shared._header')
@stop

@section('content')

	<div class="container">
		<div class="row">

			<section class="col-xs-12 col-md-8">
				<p>Hey</p>
			</section>

			<section class="col-xs-12 col-md-4">
				<p>Search</p>
			</section>

		</div>
	</div>
	
@stop

@section('footer')
	@include('shared._footer')
@stop