<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function totalByStatus(Request $request)
    {
        $query = strtolower($request->input('q'));

        $db = DB::table('invoice_lines')
            ->select(DB::raw('sum(invoice_lines.value) as total, invoice_headers.status, locations.name'))
            ->join('invoice_headers', 'invoice_headers.id', '=', 'invoice_lines.invoice_header_id')
            ->join('locations', 'locations.id', '=', 'invoice_headers.location_id')
            ->groupBy('status', 'name');

        if (!empty($query)) {
            $db->where('locations.id', '=', $query);
        }

        $totalByStatus = $db->get();

        return response()->json(['data' => $totalByStatus], 200);
    }
}
