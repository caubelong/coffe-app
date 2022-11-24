<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Topping extends Model
{
    use HasFactory;
    protected $table="topping";
    protected $primaryKey="id";
    protected $fillable=['name','price','discount','status','created_by'];
    public function getCreatedBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
}
