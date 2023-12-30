<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function getQrCodeUrlAttribute()
    {
        return $this->qr_code ? Storage::url($this->qr_code) : null;
    }
}
