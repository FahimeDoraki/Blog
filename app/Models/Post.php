<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'image',
        'keywords',
        'user_id',
        'slug',
        'category_id',
        'active',
        'published_at'
    ];

    public function user(){
        return $this->belongsto(User::class ,'user_id');
    }

    public function category(){
        return $this->belongsto(Category::class ,'category_id');
    }


        /**
     * Interact with the user's first name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function active(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["inactive", "active"][$value],
        );
    }

}
