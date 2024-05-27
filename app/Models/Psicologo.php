<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Psicologo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];

    public function user(): HasOne {
        return $this->hasOne(User::class);
    }
}
