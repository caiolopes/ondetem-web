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

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function confirmations() {
        return $this->hasMany('App\Confirmation');
    }
}
