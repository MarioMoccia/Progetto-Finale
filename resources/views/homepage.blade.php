<x-layout>
    <div class="container my-5">
        <div class="row align-items-center justify-content-center text-center py-4">
            <div class="col-12">
                <h1 class="display-4">{{ __('ui.welcome') }}</h1>
                <p class="lead text-muted">{{ __('ui.welcomeSubtitle') }}</p>
                @auth
                    <a class="btn btn-dark mt-3" href="{{ route('articles.create') }}">{{ __('ui.insertArticle') }}</a>
                @endauth
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">{{ __('ui.latestArticles') }}</h2>
            <a href="{{ route('articles.index') }}" class="btn btn-outline-dark btn-sm">{{ __('ui.seeAll') }}</a>
        </div>
        <div class="row g-4">
            @forelse ($articles as $article)
                <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                    <x-card :article="$article" />
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">{{ __('ui.noArticlesYet') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
