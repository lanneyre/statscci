<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'dd',
        'df',
        'numMarche',
        'numConvention',
        'centre_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * Get the centre that owns the formation.
     */
    public function centre()
    {
        return $this->belongsTo(Centre::class);
    }

    /**
     * The critere that belong to the formation.
     */
    public function criteres()
    {
        return $this->belongsToMany(Critere::class)->withPivot('valeur');
    }
}
