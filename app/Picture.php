<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'link',
    ];

    protected $guarded = [
        'post_id',
    ];

    /**
     * Get the post that owns the picture
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
