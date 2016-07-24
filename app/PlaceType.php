<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceType extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'place_types';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'pivot'
    ];

    public function members() {
        return $this->belongsToMany('App\Place')->withTimestamps();
    }
}
