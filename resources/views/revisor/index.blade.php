<x-layout>
    <div class="container my-5">
        <h1 class="mb-4">Zona revisore</h1>

        @if ($article_to_check)
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <h2>{{ $article_to_check->title }}</h2>
                    <h5 class="text-muted">Autore: {{ $article_to_check->user->name }}</h5>
                    <h4 class="text-primary">{{ number_format($article_to_check->price, 2) }} &euro;</h4>
                    <p class="fst-italic">{{ __('ui.'.$article_to_check->category->name) }}</p>
                    <p>{{ $article_to_check->description }}</p>
                    <div class="d-flex gap-2 mt-3">
                        <form action="{{ route('revisor.reject', $article_to_check) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger px-4">Rifiuta</button>
                        </form>
                        <form action="{{ route('revisor.accept', $article_to_check) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success px-4">Accetta</button>
                        </form>
                    </div>
                </div>
            </div>

            @if ($article_to_check->images->count())
                @foreach ($article_to_check->images as $key => $image)
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ $image->getUrl(\App\Models\Image::CROP_WIDTH, \App\Models\Image::CROP_HEIGHT) }}" class="img-fluid rounded-start" alt="Immagine {{ $key + 1 }} dell'articolo '{{ $article_to_check->title }}'">
                            </div>
                            <div class="col-md-5 ps-3">
                                <div class="card-body">
                                    <h6>Labels</h6>
                                    @if ($image->labels)
                                        @foreach ($image->labels as $label)
                                            <span class="badge text-bg-light border me-1 mb-1">{{ $label }}</span>
                                        @endforeach
                                    @else
                                        <p class="fst-italic text-muted">Nessuna etichetta rilevata</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-body">
                                    <h6>Ratings</h6>
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span>adult</span><i class="{{ $image->adult }}"></i>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span>violence</span><i class="{{ $image->violence }}"></i>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span>spoof</span><i class="{{ $image->spoof }}"></i>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span>racy</span><i class="{{ $image->racy }}"></i>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span>medical</span><i class="{{ $image->medical }}"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row g-2">
                    @for ($i = 0; $i < 6; $i++)
                        <div class="col-6 col-md-4 mb-4 text-center">
                            <img src="https://picsum.photos/seed/{{ $article_to_check->id }}{{ $i }}/300/200" class="img-fluid rounded shadow" alt="Immagine segnaposto">
                        </div>
                    @endfor
                </div>
            @endif
        @else
            <div class="text-center py-5">
                <h3 class="fst-italic text-muted">Nessun annuncio da revisionare</h3>
                <a href="{{ route('homepage') }}" class="btn btn-dark mt-3">Torna alla homepage</a>
            </div>
        @endif
    </div>
</x-layout>
