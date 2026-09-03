<x-layout>
    <div class="container my-5">
        <div class="row g-4">
            <div class="col-12 col-md-6">
                @if ($article->images->count() > 0)
                    <div id="articleCarousel" class="carousel slide shadow-sm" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($article->images as $key => $image)
                                <div class="carousel-item @if($loop->first) active @endif">
                                    <img src="{{ Storage::url($image->path) }}" class="d-block w-100 rounded" alt="Immagine {{ $key + 1 }} dell'articolo '{{ $article->title }}'">
                                </div>
                            @endforeach
                        </div>
                        @if ($article->images->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#articleCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Precedente</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#articleCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Successivo</span>
                            </button>
                        @endif
                    </div>
                @else
                    <img src="https://picsum.photos/seed/{{ $article->id }}/600/400" class="d-block w-100 rounded shadow-sm" alt="Nessuna foto inserita dall'utente">
                @endif
            </div>
            <div class="col-12 col-md-6">
                <h1>{{ $article->title }}</h1>
                <h3 class="text-primary mb-3">{{ number_format($article->price, 2) }} &euro;</h3>
                <a href="{{ route('articles.byCategory', $article->category) }}" class="badge text-bg-secondary text-decoration-none mb-3 d-inline-block">{{ $article->category->name }}</a>
                <p>{{ $article->description }}</p>
            </div>
        </div>
    </div>
</x-layout>
