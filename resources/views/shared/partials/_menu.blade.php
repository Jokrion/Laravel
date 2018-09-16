<nav class="navbar navbar-expand-lg navbar-light bg-light">
    @if(!isset($footer))
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    @endif

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/') }}">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('stages') }}">Stage</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('formations') }}">Formation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('contact') }}">Contact</a>
            </li>
        </ul>
    </div>
</nav>