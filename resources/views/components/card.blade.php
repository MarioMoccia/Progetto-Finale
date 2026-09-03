@props(['article'])

<div class="card h-100 shadow-sm border-0">
    <img src="{{ $article->images->isNotEmpty() ? Storage::url($article->images->first()->path) : 'https://picsum.photos/seed/'.$article->id.'/400/250' }}" class="card-img-top" alt="Immagine dell'annuncio {{ $article->title }}">
    <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{ $article->title }}</h5>
        <p class="text-muted mb-3">{{ number_format($article->price, 2) }} &euro;</p>
        <div class="mt-auto d-flex justify-content-between">
            <a href="{{ route('articles.show', $article) }}" class="btn btn-sm btn-primary">{{ __('ui.details') }}</a>
            <a href="{{ route('articles.byCategory', $article->category) }}" class="btn btn-sm btn-outline-secondary">{{ __('ui.'.$article->category->name) }}</a>
        </div>
    </div>
</div>
