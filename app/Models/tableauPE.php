<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tableauPE extends Model
{
    use HasFactory;
    public $data;

    public function __construct($d)
    {
        $this->data = $d;
    }
}
