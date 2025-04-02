<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;
    // protected $table='categories';
    // protected $connection='mysql';
    // protected $primaryKey='id';
    // protected $keyType='int';
    // public $incrementing=true;

    // One-to-Many(one Category has many Posts)
    public function posts(){
            return $this->hasMany(
            Post::class //Related model
            // 'category_id',//fk in the related moddel
            // 'id' //pk in the current model
        );
    }
    //  one-to-manyالكاتيجوري الواحد بتبع اله اكتر من كاتيجوري وهي علاقه
    public function children(){
        return $this->hasMany(Category::class,'parent_id','id');
    }
    // العلاقه العكسيه
    public function parent(){
        return $this->BelongsTo(Category::class,'parent_id','id')->withDefault();
    }
}
