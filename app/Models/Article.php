<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function setAccepted(bool $value): bool
    {
        $this->is_accepted = $value;

        return $this->save();
    }

    public static function toBeRevisedCount(): int
    {
        return Article::where('is_accepted', null)->count();
    }
}
