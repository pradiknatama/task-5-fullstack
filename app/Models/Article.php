<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $table = 'articles';
	protected $primaryKey = 'id';
    protected $fillable =[
        'title','image','content','user_id','category_id'
    ];
}
