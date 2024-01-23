<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'author', 
        'subject', 
        'isbn', 
        'issn', 
        'available', 
        'school'
    ];

    public function scopeSearch($query, $searchTerm){
        return $query->where('title', 'like', '%' . $searchTerm . '%')
                     ->orWhere('author', 'like', '%' . $searchTerm . '%')
                     ->orWhere('subject', 'like', '%' . $searchTerm . '%')
                     ->orWhere('isbn', 'like', '%' . $searchTerm . '%')
                     ->orWhere('issn', 'like', '%' . $searchTerm . '%');
    }
}
