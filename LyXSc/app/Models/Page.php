<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
class Page extends Model  implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $fillable = [
        'file_name', 'file_size', 'id', 'chapter_id', 'file_url'
    ];
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('page_custom')
            ->width(720)
            ->withResponsiveImages()
            ->sharpen(10)
            ->quality(75)
            ->queued();
    }
    public function chapter(){

        return $this->hasOne( Chapter::class, 'id', 'chapter_id');
    }
}
