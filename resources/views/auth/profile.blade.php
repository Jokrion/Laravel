@extends('layouts.master', ['title' => 'Mon compte'])

@section('header')
    @include('shared._header')
@stop

@section('content')
    <div class="container">
        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <h2>Mes événements</h2>

        <div class="row">
            <div class="col-md-4 col-12">
                {{ $posts->links() }}
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped w-auto">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Type</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Début</th>
                        <th scope="col">Fin</th>
                        <th scope="col">Catégorie</th>
                        <th scope="col"></th>
                        @if($posts->count() > 1) <th scope="col"></th> @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <th scope="row">{{ $post->id }}</th>
                            <td>{{ ($post->isFormation()) ? 'Formation' : 'Stage' }}</td>
                            <td><a href="{{ url('post', $post->id) }}">{{ $post->title }}</a></td>
                            <td>{{ $post->start_date }}</td>
                            <td>{{ $post->end_date }}</td>
                            <td>{{ $post->category->title }}</td>
                            <td class="flex">
                                <a href="#" onclick="openModal(event, 'des', {{ $post->id }});"><span class="oi oi-ban" title="Se désinscrire" aria-hidden="true"></span></a>
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
                            <td>Vous ne participez à aucune événement actuellement.</td>
                        </tr>
                    @endforelse
                    @if(!empty($posts))
                        <tr>
                            <th scope="row">#</th>
                            <td></td>
                            <td>Total : {{ $posts->total() }} événements</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <span style="display: none;" id="postid"></span>

    @include('admin.partials._modal', ['id' => 'desModal', 'text' => 'Êtes-vous sûr de vouloir vous désinscrire de cet événement ?', 'method' => 'unparticipate', 'button_text' => 'Oui', 'args' => [url('unparticipate/#'), url(' ')]])
@endsection

@section('footer')
    @include('shared._footer')
    <script src="{{ asset('js/user.js') }}"></script>
@stop