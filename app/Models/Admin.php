<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function fio(): Attribute
    {
        return new Attribute(
            get: fn() => $this->name,
        );
    }
}
