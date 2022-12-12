<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'expirationDate',
        'dateOfCreation',
        'updateDate',
        'priority',
        'status',
        'creator_id',
        'responsible_id',
    ];
}
