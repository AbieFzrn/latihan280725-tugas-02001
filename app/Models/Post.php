<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    use HasFactory;
    protected $fillable = ['judul', 'isi', 'kategori_id', 'user_id', 'gambar'];

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function fotos() {
        return $this->hasMany(Foto::class);
    }
}