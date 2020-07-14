<?php

use App\InvoiceHeader;
use App\InvoiceLines;
use App\Status;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [1, 2, 3];
        $status = [
          Status::PROCESSED,
          Status::OPEN,
          Status::DRAFT
        ];

        foreach ($locations as $location_id) {
            for ($i = 0; $i < 10; $i++) {
                $attributes = [
                    'location_id' => $location_id,
                    'status' => $status[random_int(0, 2)]
                ];

                $invoiceHeader = new InvoiceHeader($attributes);
                $invoiceHeader->save();

                for ($j = 0; $j < 5; $j++) {
                    $item = [
                        'invoice_header_id' => $invoiceHeader->id,
                        'description' => 'line ' . str_pad($j, 3, '0'),
                        'value' => (string) random_int(5, 25)
                    ];

                    $invoiceItem = new InvoiceLines($item);
                    $invoiceItem->save();
                }
            }
        }
    }
}
