<nav class="navbar navbar-expand-lg navbar-light bg-light">
    @if(!isset($footer))
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    @endif

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item" id="home">
                <a class="nav-link" href="{{ url('/') }}">Accueil</a>
            </li>
            <li class="nav-item" id="int">
                <a class="nav-link" href="{{ url('stages') }}">Stage</a>
            </li>
            <li class="nav-item" id="train">
                <a class="nav-link" href="{{ url('formations') }}">Formation</a>
            </li>
            <li class="nav-item" id="contact">
                <a class="nav-link" href="{{ url('contact') }}">Contact</a>
            </li>
        </ul>
        @if(!isset($footer))
            <ul class="navbar-nav navbar-right">
                @if(auth()->user())
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item" id="admin">
                            <a class="nav-link" href="{{ url('admin') }}">Panneau d'administration</a>
                        </li>
                    @else
                        <li class="nav-item" id="admin">
                            <a class="nav-link" href="{{ url('profile') }}">Mon compte</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('logout') }}">Se déconnecter</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('login') }}">Se connecter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('register') }}">S'enregistrer</a>
                    </li>
                @endif
            </ul>
        @endif
    </div>
</nav>