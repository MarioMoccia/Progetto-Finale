<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateArticleForm extends Component
{
    #[Validate('required|string|max:255')]
    public string $title = '';

    #[Validate('required|string|min:10')]
    public string $description = '';

    #[Validate('required|numeric|min:0.01')]
    public string $price = '';

    #[Validate('required|exists:categories,id')]
    public string $category_id = '';

    public bool $success = false;

    public function messages(): array
    {
        return [
            'title.required' => 'Il titolo è obbligatorio',
            'title.max' => 'Il titolo non può superare 255 caratteri',
            'description.required' => 'La descrizione è obbligatoria',
            'description.min' => 'La descrizione deve contenere almeno 10 caratteri',
            'price.required' => 'Il prezzo è obbligatorio',
            'price.numeric' => 'Il prezzo deve essere un numero',
            'price.min' => 'Il prezzo deve essere maggiore di 0',
            'category_id.required' => 'La categoria è obbligatoria',
            'category_id.exists' => 'La categoria selezionata non è valida',
        ];
    }

    public function store(): void
    {
        $this->validate();

        Article::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'user_id' => auth()->id(),
        ]);

        $this->reset(['title', 'description', 'price', 'category_id']);
        $this->success = true;
    }

    public function render()
    {
        return view('livewire.create-article-form');
    }
}
