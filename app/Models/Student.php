<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'birthday',
        'group_id',
    ];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }

    public function fio(): Attribute
    {
        return new Attribute(
            get: fn() => "$this->last_name $this->first_name $this->middle_name",
        );
    }
}
