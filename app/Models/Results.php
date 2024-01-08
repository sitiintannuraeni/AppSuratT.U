<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    protected $table = "results";

    protected $fillable = [
        'letter_id',
        'notes',
        'presence_recipients' // ['Dinda', 'Aira'],
    ];

    public function letter()
    {
        return $this->hasOne(Letters::class, 'id', 'letter_id');
    }
}
