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
        'fileName', 'fileSize', 'id', 'chapter_id', 'fileUrl'
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
    public function getPage()
    {
        return  $this->getFirstMediaUrl(['page' , 'page_custom']);
    }
}
