<nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('homepage') }}">Presto.it</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('homepage') }}">{{ __('ui.home') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('articles.index') }}">{{ __('ui.allArticles') }}</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ __('ui.categories') }}
          </a>
          <ul class="dropdown-menu">
            @foreach($categories as $category)
              <li><a class="dropdown-item" href="{{ route('articles.byCategory', $category) }}">{{ __('ui.'.$category->name) }}</a></li>
            @endforeach
          </ul>
        </li>
      </ul>

      <form class="d-flex" role="search" action="{{ route('articles.search') }}" method="GET">
        <div class="input-group">
          <input type="search" name="query" class="form-control" placeholder="{{ __('ui.searchPlaceholder') }}" aria-label="{{ __('ui.search') }}">
          <button type="submit" class="input-group-text btn btn-outline-success">{{ __('ui.search') }}</button>
        </div>
      </form>

      <div class="d-flex align-items-center mx-2">
        <x-_locale lang="it" />
        <x-_locale lang="gb" />
        <x-_locale lang="fr" />
      </div>

      <ul class="navbar-nav ms-auto">
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('ui.login') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('ui.register') }}</a>
          </li>
        @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="{{ route('articles.create') }}">📢 {{ __('ui.createArticle') }}</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">{{ __('ui.profile') }}</a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item">{{ __('ui.logout') }}</button>
                </form>
              </li>
            </ul>
          </li>
          @if (Auth::user()->is_revisor)
            <li class="nav-item">
              <a class="nav-link btn btn-outline-success btn-sm position-relative ms-2" href="{{ route('revisor.index') }}">
                {{ __('ui.reviewZone') }}
                @if (\App\Models\Article::toBeRevisedCount() > 0)
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ \App\Models\Article::toBeRevisedCount() }}</span>
                @endif
              </a>
            </li>
          @endif
        @endguest
      </ul>
    </div>
  </div>
</nav>