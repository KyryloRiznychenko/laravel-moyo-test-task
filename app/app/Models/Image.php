<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'position',
        'filename',
        'path',
        'mime_type'
    ];

    protected $appends = [
        'src'
    ];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getSrcAttribute(): string
    {
        return Storage::disk('public')->url($this->attributes['path']);
    }
}
