<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(mixed $id)
 */
class Task extends Model

{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'content',
        'done',
    ];
    use HasFactory;
}
