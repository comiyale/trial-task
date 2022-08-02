<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagsAndNotes extends Model {
    protected $table = 'tags_and_notes_relationship';

    protected $fillable = [
        'id',
        'tags_id',
        'notes_id',
        'tag_name',
        'updated_at',
        'created_at'
    ];
}