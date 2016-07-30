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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'pivot', 'user_id', 'place_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'exists' => 'boolean',
    ];

    public function place() {
        return $this->belongsTo('App\Place');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
