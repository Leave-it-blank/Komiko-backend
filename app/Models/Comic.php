<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
class Comic extends Model implements HasMedia, Viewable
{

    use InteractsWithViews;
    use InteractsWithMedia;
    use HasFactory;
    use SoftDeletes;
    use HasSlug;
    protected $hidden = [
        'deleted_at',
    ];
    protected $fillable = [
        'uid','title', 'description', 'author_id', 'artist_id','publisher_id', 'thumbnailUrl', 'url', 'slug',
        'titleSlug', 'isNovel', 'isMature', 'isLocked', 'isHidden','country_id','upload_date'
    ];
    protected $dates = [ 'deleted_at' ];
    protected $removeViewsOnDelete = true;

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['uid','title'])
            ->saveSlugsTo('titleSlug');
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbsm')
            ->width(450)
            ->height(650)
            ->quality(.7)
            ->nonQueued();
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);

    }
    public function country()
    {
        return $this->belongsTo(country::class,'country_id')->withDefault([
            'id' => 0,
            'name' => 'south korea',
            'cid' => 'default',
            'code' => 91
        ]);
    }

    public function author()
    {
        return $this->belongsTo(Author::class,  'author_id')->withDefault([
            'id' => 0,
            'name' => 'south korea',
        ]);
    }
    public function artist()
    {
        return $this->belongsTo(Artist::class,  'artist_id')->withDefault([
            'id' => 0,
            'name' => 'south korea',
        ]);
    }
    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id')->withDefault([
            'id' => 0,
            'name' => 'south korea',
            'pub_id' => Str::uuid()
        ]);
    }

    public function scopeIsVisible(Builder $query)
    {
        return $query->where('isHidden', false);
    }
    public function scopeIsLocked(Builder $query)
    {
        return $query->where('isLocked', false);
    }
    public function volumes()
    {
        return $this->hasMany(Volume::class, 'comic_id', 'id');
    }

    public function chapters(){
        return $this->hasManyThrough(Chapter::class, Volume::class);
    }
    public function chapters_count_get(){
        return $this->hasManyThrough(Chapter::class, Volume::class)->count();
    }

    public function getThumbnailUrl()
    {
        return $this->getFirstMediaUrl('thumbnail','thumbsm');
    }
    public function getFullThumbnailOptimizedUrl()
    {
        return $this->getFirstMediaUrl('thumbsm' );
    }
    public function getFullThumbnailUrl()
    {
        return $this->getFirstMediaUrl('thumbnail' );
    }
    public function getURL(): string|\Illuminate\Contracts\Routing\UrlGenerator|\Illuminate\Contracts\Foundation\Application
    {
        return  route('reader.comic.data', ['comic'=> $this->title_slug]);
    }
    public function getFirstChapter(){
        return $this->hasManyThrough(Chapter::class, Volume::class)->first();
    }
}
