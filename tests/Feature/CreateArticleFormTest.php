<?php

use App\Livewire\CreateArticleForm;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

test('guests cannot access the create article page', function () {
    $this->get(route('articles.create'))->assertRedirect(route('login'));
});

test('an authenticated user can create an article with multiple photos', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    $category = Category::create(['name' => 'Elettronica']);

    Livewire::actingAs($user)
        ->test(CreateArticleForm::class)
        ->set('title', 'Chitarra elettrica')
        ->set('description', 'Usata pochissimo, ottime condizioni.')
        ->set('price', '150')
        ->set('category_id', $category->id)
        ->set('temporary_images', [
            UploadedFile::fake()->image('foto1.jpg'),
            UploadedFile::fake()->image('foto2.jpg'),
        ])
        ->call('store')
        ->assertSet('success', true);

    $article = $user->articles()->first();

    expect($article)->not->toBeNull()
        ->and($article->title)->toBe('Chitarra elettrica')
        ->and($article->is_accepted)->toBeNull()
        ->and($article->images)->toHaveCount(2);

    Storage::disk('public')->assertExists($article->images->first()->path);
});

test('an article cannot have more than 6 photos', function () {
    Storage::fake('public');

    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(CreateArticleForm::class)
        ->set('temporary_images', [
            UploadedFile::fake()->image('1.jpg'),
            UploadedFile::fake()->image('2.jpg'),
            UploadedFile::fake()->image('3.jpg'),
            UploadedFile::fake()->image('4.jpg'),
            UploadedFile::fake()->image('5.jpg'),
            UploadedFile::fake()->image('6.jpg'),
            UploadedFile::fake()->image('7.jpg'),
        ])
        ->assertHasErrors(['temporary_images']);
});
