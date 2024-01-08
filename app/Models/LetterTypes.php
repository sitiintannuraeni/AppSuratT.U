<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterTypes extends Model
{
    protected $table = "letter_types";

    protected $fillable = [
        'id',
        'letter_code',
        'name_type',
    ];

    public function letters()
    {
        return $this->hasMany( Letters::class, 'letter_type_id', 'id');
    }

}
