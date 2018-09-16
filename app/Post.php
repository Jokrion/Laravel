<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	/* Post types */
    const FORMATION_TYPE = 'formation';
    const STAGE_TYPE = 'stage';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_type', 'title', 'description', 'start_date', 'end_date', 'price', 'max_students', 'published', 'category_id',
    ];

    /**
     * Get the picture record associated with the post
     */
    public function picture()
    {
        return $this->hasOne('App\Picture');
    }

    /**
     * Get the category of the post
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * This function returns true if the post type is FORMATION_TYPE
     *
     * @return boolean
     */
    public function isFormation()
    {        
        return $this->type === self::FORMATION_TYPE;    
    }

    /**
     * This function returns true if the post type is STAGE_TYPE
     *
     * @return boolean
     */
    public function isStage()
    {        
        return $this->type === self::STAGE_TYPE;    
    }

}
