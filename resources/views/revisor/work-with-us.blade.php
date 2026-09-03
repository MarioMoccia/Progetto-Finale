<x-layout>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 text-center">
                        <h2 class="mb-3">Lavora con noi</h2>
                        <p class="text-muted">Vuoi diventare revisore e aiutarci a moderare gli annunci? Invia la tua richiesta, il nostro team ti ricontatterà.</p>
                        <form method="POST" action="{{ route('revisor.request') }}">
                            @csrf
                            <button type="submit" class="btn btn-success">Invia richiesta</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
