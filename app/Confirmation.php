<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'confirmations';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function place() {
        return $this->belongsTo('App\Place');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
