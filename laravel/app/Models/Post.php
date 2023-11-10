<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


Class Post extends Model 
{
    use HasFactory;
    protected $fillable = [
        'body',
        'file_id',
        'latitude',
        'longitude',
        'author_id',
    ];
    public function post()
{
   return $this->hasOne(Post::class);
}
public function user()
{
   return $this->belongsTo(User::class, 'author_id');
}

}