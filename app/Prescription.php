<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Prescription extends Model
{   
    use Uuid;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prescriber_id', 'patient_id', 'note',
    ];

    public function patient()
    {
        return $this->belongsTo('App\User', 'patient_id');
    }

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
