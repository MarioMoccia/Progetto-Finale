<x-layout>
    <div class="container my-5">
        <div class="row min-vh-100 align-items-center justify-content-center text-center">
            <div class="col-12">
                <h1 class="display-4">Benvenuto su Presto.it</h1>
                <p class="lead text-muted">Scopri offerte, vendi con semplicità .</p>
                @auth
                    <a class="btn btn-dark mt-3" href="{{ route('articles.create') }}">Inserisci annuncio</a>
                @endauth
            </div>
        </div>
    </div>
</x-layout>
