<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clanguage extends Model
{
    use HasFactory;

    protected $fillable = ['cat'];

    public function setCatAttribute($value)
    {
        return $this->attributes['cat'] = json_encode($value);
    }
}
