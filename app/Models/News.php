<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image_path',
        'status',
        'published_at',
        'author_id',
        'author_name',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getAuthorDisplayNameAttribute(): string
    {
        if (! empty($this->author_name)) {
            return $this->author_name;
        }

        return $this->author?->name ?? 'Humas Kanwil Kemenkumham Riau';
    }

    /**
     * Scope for published news only.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Accessor for full image url.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (blank($this->image_path)) {
            return null;
        }

        // If stored as asset path or url directly
        if (Str::startsWith($this->image_path, ['http://', 'https://', 'images/'])) {
            return asset($this->image_path);
        }

        return asset('storage/'.$this->image_path);
    }
}
