<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // TAMBAHKAN 'gambar' DI SINI
    protected $fillable = [
        'judul',
        'isi',
        'kategori_id',
        'user_id',
        'gambar', // <-- Ini yang paling penting
    ];

    /**
     * Get the kategori that owns the post.
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the fotos for the post.
     */
    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }
}
