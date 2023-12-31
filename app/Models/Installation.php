<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function technisian()
    {
        return $this->belongsTo(Technisian::class,'teknisi_id');
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }

    public function invoicenote()
    {
        return $this->hasMany(Invoicenote::class);
    }
}
