<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Critere extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];
    /**
     * The formation that belong to the critere.
     */
    public function formations()
    {
        return $this->belongsToMany(Formation::class)->withPivot('valeur');
    }
}
