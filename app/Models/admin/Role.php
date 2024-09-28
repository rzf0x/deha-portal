<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
    ];

    public function admins()
    {
        return $this->hasMany(Admin::class, 'roles_id');
    }
}
