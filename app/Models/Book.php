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
        'school',
        'resource_type',
        'call_number',
        'status'
    ];

    public function scopeSearch($query, $searchTerm){
        return $query->where('title', 'like', '%' . $searchTerm . '%')
                     ->orWhere('author', 'like', '%' . $searchTerm . '%')
                     ->orWhere('subject', 'like', '%' . $searchTerm . '%')
                     ->orWhere('isbn', 'like', '%' . $searchTerm . '%')
                     ->orWhere('issn', 'like', '%' . $searchTerm . '%');
    }

    public function memberLibrary()
    {
        return $this->belongsTo(MemberLibrary::class, 'school', 'id');
    }
}
