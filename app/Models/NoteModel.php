<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteModel extends Model
{
    use HasFactory;

    protected $table = 'tb_note';
    protected $fillable = [
        'id' ,'title','note','created_at','updated_at'
    ];
}
