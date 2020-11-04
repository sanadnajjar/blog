<?php

namespace App;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements Searchable
{
    use Sluggable;
    use SluggableScopeHelpers;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

    public function getSearchResult(): SearchResult
    {
        $url = route('home.post', $this->slug);

        return new SearchResult(
            $this,
            $this->title,
            $url
        );
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'separator' => '-',
                'includeTrashed' => true,
            ]
        ];
    }

    protected $fillable = [

        'category_id',
        'photo_id',
        'title',
        'body',
    ];

    protected $primaryKey = 'id';

    public function user(){

        return $this->belongsTo('App\User');
    }

    public function photo(){

        return $this->belongsTo('App\Photo');
    }

    public function category(){

        return $this->belongsTo('App\Category');
    }

    public function comments(){

        return $this->hasMany('App\Comment');
    }

    public function photoPlaceholder(){

        return "http://placehold.it/700x200";
    }

}
