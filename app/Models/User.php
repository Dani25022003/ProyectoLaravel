<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Importa esta clase
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable // Cambia esto para que extienda Authenticatable
{
    use HasFactory;

    protected $fillable = ['usuario', 'password', 'rol'];

    protected $hidden = ['password'];

    public function isAdmin()
    {
        return $this->rol === 'admin';
    }
}
