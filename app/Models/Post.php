<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];
    protected $hidden = [
        'description',
    ];

    public function user()
    {
        return $this-> belongsTo(User::class);
    }

    // or
    // public function postCreator()
    // {
    //     return $this-> belongsTo(User::class,'user_id');
    // }

    protected function casts(): array
    {
        return [
            'title' => 'hashed',
        ];
    }
}