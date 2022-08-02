<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model {
    protected $table = 'notes';

    protected $fillable = [
        'id',
        'status',
        'title',
        'description',
        'updated_at',
        'created_at'
    ];

    public function tags() {
        return $this->hasMany('App\Models\TagsAndNotes');
    }

    public function tag() {
        return $this->belongsTo('App\Models\TagsAndNotes');
    }
}