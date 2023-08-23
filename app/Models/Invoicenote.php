<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoicenote extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function installation()
    {
        return $this->belongsTo(Installation::class);
    }
}
