<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formation extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
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
    public function centres()
    {
        return $this->belongsTo(Centre::class, "centre_id");
    }

    // public function critere(Critere $c)
    // {
    //     $criteres = $this->criteres()->where('critere_id', $c->id)->first()->pivot->valeur;
    //     dump($this->id . "->" . $criteres);
    //     // foreach ($criteres as $critere) {
    //     //     //dump($critere);
    //     //     if ($critere->id == $c->id && $critere->pivot->formation_id == $this->id) {
    //     //         return $critere->pivot->valeur;
    //     //     }
    //     // }
    //     return 0;
    // }

    /**
     * The critere that belong to the formation.
     */
    public function criteres()
    {
        return $this->belongsToMany(Critere::class)->withPivot('valeur');
    }
}
