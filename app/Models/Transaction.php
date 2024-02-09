<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";

    protected $fillable = [
        'user_id', 
        'book_id', 
        'status', 
        'reserved_date', 
        'return_date',
        'ampm_session',
    ];

    public function borrowerBook()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function borrowerUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
