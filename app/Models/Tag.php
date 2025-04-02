<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','slug'
    ];
    protected static function booted()
    {
        static::creating(function(Tag $tag){
            $tag->slug=Str::slug($tag->name);
        });
    }
    public function posts(){
        return $this->belongsToMany(
        Post::class,//related model
        'post_tag',//the name of table connection(pivot table)
        'tag_id',//fk for the current model in pivot table
        'post_id',//fk for the related model in pivot table
        'id',//pk for current mode
        'id'//pk for related mode
    );
}
}
