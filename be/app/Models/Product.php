<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
class Product extends Model
{
    use HasFactory;
    protected $table = "product";
    protected $primaryKey="id";
    protected $fillable=["name","cate_id","price","discount","thumbnail","created_by","desc","status"];
    public function getCreatedBy(){
       return $this->belongsTo(User::class,'created_by','id');
    }
    public function getCategory(){
       return $this->belongsTo(Category::class,'cate_id','id');
    }
}
