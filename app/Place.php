<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use UuidForKey;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'places';

    public $incrementing = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function confirmations() {
        return $this->hasMany('App\Confirmation');
    }

    public function place_type() {
        return $this->belongsToMany('App\PlaceType')->withTimestamps();
    }
}
