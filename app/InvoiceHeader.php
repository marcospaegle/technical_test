<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceHeader extends Model
{
    protected $fillable = [
        'location_id', 'status'
    ];

    public function items()
    {
        return $this->hasMany(InvoiceLines::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function total()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += (float) $item->value;
        }

        return $total;
    }
}
