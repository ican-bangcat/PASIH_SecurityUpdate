<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LandingBanner extends Model
{
    use HasFactory;

    protected $table = 'landing_banners';

    protected $fillable = [
        'title',
        'image_path',
        'order',
        'is_active',
        'description',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Scope for active landing banners ordered by sequence.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc');
    }

    /**
     * Accessor for full image url.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (blank($this->image_path)) {
            return null;
        }

        if (Str::startsWith($this->image_path, ['http://', 'https://', 'images/'])) {
            return asset($this->image_path);
        }

        return asset('storage/'.$this->image_path);
    }
}
