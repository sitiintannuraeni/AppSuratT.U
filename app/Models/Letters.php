<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letters extends Model
{
    protected $table = "letters";

    protected $fillable = [
        'id',
        'letter_type_id',
        'letter_perihal',
        'recipients',
        'content',
        'attachment',
        'notulis',
    ];

    public function letterTypes()
    {
        return $this->hasOne(LetterTypes::class, 'id', 'letter_type_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'notulis');
    }

    public function result()
    {
        return $this->hasOne(Results::class, 'letter_id', 'id');
    }
}
