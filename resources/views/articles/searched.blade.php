<x-layout>
    <div class="container my-5">
        <h1 class="mb-4">Risultati per la ricerca <span class="fst-italic">{{ $query }}</span></h1>
        <div class="row g-4">
            @forelse ($articles as $article)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <x-card :article="$article" />
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">Nessun annuncio corrisponde alla tua ricerca.</p>
                </div>
            @endforelse
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $articles->links() }}
        </div>
    </div>
</x-layout>
