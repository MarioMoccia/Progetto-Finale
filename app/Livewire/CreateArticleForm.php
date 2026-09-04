<?php

namespace App\Livewire;

use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\ResizeImage;
use App\Models\Article;
use App\Models\Image;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateArticleForm extends Component
{
    use WithFileUploads;

    #[Validate('required|string|max:255')]
    public string $title = '';

    #[Validate('required|string|min:10')]
    public string $description = '';

    #[Validate('required|numeric|min:0.01')]
    public string $price = '';

    #[Validate('required|exists:categories,id')]
    public string $category_id = '';

    public array $images = [];

    public $temporary_images;

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

    public function updatedTemporaryImages(): void
    {
        if ($this->validate([
            'temporary_images.*' => 'image|max:1024',
            'temporary_images' => 'max:6',
        ])) {
            foreach ($this->temporary_images as $image) {
                $this->images[] = $image;
            }
        }
    }

    public function removeImage($key): void
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
        }
    }

    public function store(): void
    {
        $this->validate();

        $article = Article::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'user_id' => auth()->id(),
        ]);

        if (count($this->images) > 0) {
            foreach ($this->images as $image) {
                $newImage = $article->images()->create(['path' => $image->store("articles/{$article->id}", 'public')]);
                dispatch(new ResizeImage($newImage->path, Image::CROP_WIDTH, Image::CROP_HEIGHT));
                dispatch(new GoogleVisionSafeSearch($newImage->id));
                dispatch(new GoogleVisionLabelImage($newImage->id));
            }
        }

        $this->reset(['title', 'description', 'price', 'category_id', 'images', 'temporary_images']);
        $this->success = true;
    }

    public function render()
    {
        return view('livewire.create-article-form');
    }
}
