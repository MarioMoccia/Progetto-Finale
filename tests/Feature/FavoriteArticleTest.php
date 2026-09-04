<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\User;

test('guests cannot favorite an article', function () {
    $article = Article::create([
        'title' => 'Chitarra',
        'description' => 'Chitarra in ottime condizioni.',
        'price' => 100,
        'category_id' => Category::create(['name' => 'Elettronica'])->id,
        'user_id' => User::factory()->create()->id,
    ]);

    $this->post(route('articles.favorite', $article))->assertRedirect(route('login'));
});

test('an authenticated user can toggle an article as favorite', function () {
    $user = User::factory()->create();
    $article = Article::create([
        'title' => 'Chitarra',
        'description' => 'Chitarra in ottime condizioni.',
        'price' => 100,
        'category_id' => Category::create(['name' => 'Elettronica'])->id,
        'user_id' => User::factory()->create()->id,
    ]);

    expect($article->isFavoritedBy($user))->toBeFalse();

    $this->actingAs($user)->post(route('articles.favorite', $article))->assertRedirect();

    expect($article->fresh()->isFavoritedBy($user))->toBeTrue();

    $this->actingAs($user)->post(route('articles.favorite', $article))->assertRedirect();

    expect($article->fresh()->isFavoritedBy($user))->toBeFalse();
});
