<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;
class Article extends Model
{
    use HasFactory;
    protected $table = 'articles';
	protected $primaryKey = 'id';
    protected $fillable =[
        'title','image','content','user_id','category_id'
    ];
    public function kategori(){
        return $this->hasOne(Category::class,'id','category_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
