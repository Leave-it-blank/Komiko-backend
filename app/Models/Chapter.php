<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Illuminate\Database\Eloquent\Builder;

class Chapter extends Model implements Viewable
{

    use InteractsWithViews;
    use HasFactory;

    protected $fillable = [
        'name', 'number', 'id', 'volume_id', 'isLocked', 'comic_id'
    ];
    protected $removeViewsOnDelete = true;

    public function volume(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Volume::class, 'volume_id', 'id');
    }
    public function pages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Page::class, 'chapter_id', 'id');
    }
    /*     public function views_count(Chapter $chapter): int
    {
        return views($chapter)->unique()->remember(now()->addHour(12))->count();
    } */

    public function get_chapter_url()
    {
        return route('reader.comic.chapter', ['comic' => $this->volume->comic->title_slug, 'volume' => $this->volume->number, 'chapter' => $this->number]);
    }
}
