<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name'
    ];

    public function invoices()
    {
        return $this->hasMany(InvoiceHeader::class);
    }
}
