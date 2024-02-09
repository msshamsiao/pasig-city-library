<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberLibrary extends Model
{
    use HasFactory;

    protected $table = 'member_libraries';

    protected $fillable = [
        'name',
        'email',
        'description',
        'status',
        'image_logo',
        'link'
    ];

    protected $primaryKey = 'id'; // Ensure it matches your actual primary key field

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
