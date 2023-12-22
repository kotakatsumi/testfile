<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $guarded =['id'];
    protected $filable =[
        'category_id',
        'fullname',
        'gender',
        'email',
        'tell',
        'address',
        'building',
        'detail',
    ];

    public static $rules = array(
        'category_id'=>'integer|min:1|max:5',
        'gender'=>'integer|min:1|max:3',
        'email'=>'email',
        'tell'=>'tel',
    );

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}