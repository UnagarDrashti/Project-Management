<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tl_id',
        'emp_id',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'tl_id');
    }

    public function employee()
    {
        return $this->hasMany(User::class, 'id', 'emp_id');
    }
}
