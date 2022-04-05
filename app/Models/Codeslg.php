<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codeslg extends Model
{
    use HasFactory;

    protected $fillable = ['language'];

    public function setCatAttribute($value)
    {
        return $this->attributes['language'] = json_encode($value);
    }
}
