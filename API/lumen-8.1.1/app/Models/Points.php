<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Points extends Model {
    protected $table = 'point';

    protected $fillable = [
        'id',
        'name',
        'x',
        'y',
        'updated_at',
        'created_at'
    ];
}