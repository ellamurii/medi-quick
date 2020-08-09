<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prescriber_id', 'note',
    ];

    public function prescriber()
    {
        return $this->belongsTo('App\User', 'prescriber_id');
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
