<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table="post";
    protected $primaryKey="id";
    protected $fillable=["title","desc","body","thumbnail","status","created_by"];
    public function getCreatedBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
}
