<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Scopes\PublishedScope;
use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes; //trat
    protected $table = 'posts';
    protected $guarded = [];
    // protected $fillable = [
    //     'title', 'slug', 'category_id', 'content', 'status', 'image',
    // ];

    protected $perPage = 15; // بدل ما ضل الديفولت 15 بغيرها ل 2مثلااpaginateلتغير القيمة العددية ل
    // Accessors
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            // return asset('uploads/'.$this->image);
            return asset('storage/' . $this->image);
            // return Storage::disk('uploads')->url($this->image);
        }
        return 'https://placehold.co/600x400?text=No+Image';
    }

    // Model Event //lectuer 12
    // creating , created,updating ,updated,saving ,saved,deleting,deleted
    // restoring, restored ,retrived
    protected static function booted() //global scope
    {
        //    static::addGlobalScope('published',function(Builder $builder){
        //     $builder->where('status','=','published');
        //     // $builder->whereNull('deleted_at'); //deleted_at is null
        //    });
            // observerلربط المودل بال
        static::observe(PostObserver::class);

        // اسم الكلاس الي عملناه instans
        static::addGlobalScope(new PublishedScope);


        // static::saving(function (Post $post) {
        //     $post->slug = Str::slug($post->title);
        // });


        //  لحذف الصوره بشكل تلقائي من الداتا بيز عند حذفها من الصفحه
        // static::forceDeleted(function (Post $post) {
        //     if ($post->image) {
        //         Storage::disk('public')->delete($post->image);
        //     }
        // });
    }
    //scopeاي فنكشن سكوب لازم تبدا ب local scope
    public function scopePublished(Builder $builder)
    {
        $builder->where('status', '=', 'published');
    }
    public function scopeDraft(Builder $builder)
    {
        $builder->where('status', '=', 'draft');
    }
    public function scopeStatus(Builder $builder, $status = 'published')
    {
        $builder->where('status', '=', $status);
    }
// Inverse of one-to-many (post belongs to one category)
    public function category(){
        return $this->belongsTo(Category::class
        // ,'category_id',
        // 'id'
    )->withDefault();
    // )->withDefault([
    //     // 'name'=>'No cat.'
    //   ]);
    }

    //Inverse of many-to-many (post belongs to many tag and tags belongs to many posts)
    public function tags(){
        return $this->belongsToMany(
        Tag::class,//related model
        'post_tag',//the name of table connection(pivot table)
        'post_id',//fk for the current model in pivot table
        'tag_id',//fk for the related model in pivot table
        'id',//pk for current mode
        'id'//pk for related mode
    );
    }
}
