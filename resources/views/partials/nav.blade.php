<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Blog</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="main-navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="/articles">Articles</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                {{ $title = App\Article::latest()->published()->first()->title }}
                {{ $id = App\Article::latest()->published()->first()->id }}

                <li>{!! link_to_action('ArticlesController@show', $title, [$id]) !!}</li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        @if (Auth::check())
                            {{ Auth::user()->username }}
                        @else
                            Guest
                        @endif
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            @if (Auth::check())
                                <a href="{{ url('/articles/create') }}">Create Article</a>
                            @endif
                        </li>

                        @if (Auth::check())
                            <li role="separator" class="divider"></li>
                            <li><a href="/auth/logout">Logout</a></li>
                        @else
                            <li><a href="/auth/login">Login</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/auth/register">Register</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div><!-- .navbar-collapse -->
    </div><!-- .container-fluid -->
</nav>
