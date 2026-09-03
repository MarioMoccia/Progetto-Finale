<x-layout>
    <div class="container-fluid text-center bg-body">
        <div class="row vh-100 align-items-center justify-content-center">
            <div class="col-12">
                <h1 class="display-4">Welcome to Presto.it</h1>
                @auth
                    <p class="lead mt-4">
                        <a href="{{ route('articles.create') }}" class="btn btn-primary btn-lg">📢 Crea il tuo annuncio</a>
                    </p>
                @endauth
            </div>
        </div>
    </div>
</x-layout>