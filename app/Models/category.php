<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;



    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function childrenCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('categories');
    }
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function iconimg(){
        return $this->hasOne(uploadedfile::class, 'id','icon');
    }
    public function bannerimg(){
        return $this->hasOne(uploadedfile::class, 'id','banner');
    }
    public function bgmenuimg(){
        return $this->hasOne(uploadedfile::class, 'id','bg_menu');
    }
}
