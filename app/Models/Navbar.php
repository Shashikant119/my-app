<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    use HasFactory;

    protected $fillable = [
       //  
    ];

    public function parentmenu()
    {
        return $this->hasOne('App\Models\Navbar', 'id', 'parent_id')->orderBy('sort_order');
    }
    public function childrenmenu()
    {
        return $this->hasMany('App\Models\Navbar', 'parent_id', 'id')->orderBy('sort_order');
    }
    public static function treemenu()
    {
        return static::with(implode('.', array_fill(0, 100, 'childrenmenu')))->where('parent_id', '=', '0')->orderBy('sort_order')->get();
    }
}
