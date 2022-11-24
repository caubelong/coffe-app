<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Category extends Model
{
    use HasFactory;
    protected $table="category";
    protected $primaryKey="id";
    protected $fillable=["name","created_by"];
    public function product(){
        return $this->hasMany(Product::class,'cate_id');
    }
}
