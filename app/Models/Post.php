<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
 
class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'judul',
        'body',
    ];

    public function author_id():BelongsTo
    {
        return $this->belongsTo(User::class,"author_id");
    }
}
