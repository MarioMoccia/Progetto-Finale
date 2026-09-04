<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Presto.it</title>
    {{-- <link rel="stylesheet" href="./style.css"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <x-navbar/>
    <div class="min-vh-100">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                <strong>✓ Successo!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                <strong>✗ Errore!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{$slot}}
    </div>
    <x-footer/>
    
    @livewireScripts
</body>
</html>