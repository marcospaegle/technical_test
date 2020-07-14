<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceLines extends Model
{
    protected $fillable = [
        'invoice_header_id', 'description', 'value'
    ];

    public function header()
    {
        return $this->belongsTo(InvoiceHeader::class);
    }
}
