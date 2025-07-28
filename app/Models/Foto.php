<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model {
    use HasFactory;
    protected $fillable = ['judul', 'file', 'post_id'];
    
    public function post() {
        return $this->belongsTo(Post::class);
    }
}