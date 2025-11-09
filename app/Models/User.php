<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'usuario',
        'email',
        'contrasena',
        'nombre',
        'apellido1',
        'apellido2',
        'fecha_nacimiento',
    ];

    protected $hidden = [
        //'contrasena',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            //'contrasena' => 'hashed',
            'fecha_nacimiento' => 'date',
        ];
    }
}
