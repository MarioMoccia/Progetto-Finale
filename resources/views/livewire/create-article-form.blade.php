<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h2 class="mb-4">Crea un nuovo articolo</h2>

                    @if($success)
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Successo!</strong> Articolo creato con successo.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form wire:submit="store">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titolo</label>
                            <input type="text" wire:model.blur="title" id="title" class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizione</label>
                            <textarea wire:model.blur="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror"></textarea>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Prezzo</label><span> (€)</span>
                            <input type="number" step="0.01" min="0" wire:model.blur="price" id="price" class="form-control @error('price') is-invalid @enderror">
                            @error('price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Categoria</label>
                            <select wire:model.blur="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">Seleziona una categoria</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ __('ui.'.$category->name) }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Pubblica articolo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
