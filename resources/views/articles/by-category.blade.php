<x-layout>
    <div class="container my-5">
        <h1 class="mb-4">Annunci in <span class="fst-italic">{{ $category->name }}</span></h1>
        <div class="row g-4">
            @forelse ($articles as $article)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <x-card :article="$article" />
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">Non sono ancora stati creati annunci per questa categoria.</p>
                    @auth
                        <a href="{{ route('articles.create') }}" class="btn btn-dark">Inserisci annuncio</a>
                    @endauth
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
