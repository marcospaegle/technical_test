<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceHeaderResource;
use App\InvoiceHeader;
use App\Location;
use App\Status;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function search(Request $request)
    {
        $query = strtolower($request->input('q'));

        $invoices = [];
        if ($this->isStatus($query)) {
            $invoices = InvoiceHeader::where('status', $query)->get();
        } else {
            if (empty($query)) {
                $invoices = InvoiceHeader::all();
            } else {
                $locations = Location::where('name', 'like', "%$query%")->get();

                $invoices = collect();
                foreach ($locations as $location) {
                    $invoices = $invoices->merge($location->invoices);
                }
            }
        }

        return InvoiceHeaderResource::collection($invoices);
    }

    private function isStatus($value)
    {
        return strtolower($value) === Status::DRAFT ||
            strtolower($value) === Status::OPEN ||
            strtolower($value) === Status::PROCESSED;
    }
}
