<?php

namespace App\Http\Controllers;

use App\Models\TkdnItem;
use Illuminate\Http\Request;

class TkdnBreakdownController extends Controller
{
    public function index(Request $request)
    {
        $volume = $request->get('volume', 600);
        $duration = $request->get('duration', 12);
        $overheadPercentage = $request->get('overhead', 8);
        $marginPercentage = $request->get('margin', 12);
        $ppnPercentage = $request->get('ppn', 11);

        // Ambil semua item TKDN yang aktif
        $tkdnItems = TkdnItem::active()->orderBy('tkdn_classification')->get();

        // Hitung breakdown
        $breakdown = $this->calculateBreakdown($tkdnItems, $volume, $duration, $overheadPercentage, $marginPercentage, $ppnPercentage);

        return view('tkdn.breakdown', compact('breakdown', 'volume', 'duration', 'overheadPercentage', 'marginPercentage', 'ppnPercentage'));
    }

    private function calculateBreakdown($tkdnItems, $volume, $duration, $overheadPercentage, $marginPercentage, $ppnPercentage)
    {
        $items = [];
        $subTotalHpp = 0;

        // Hitung item-item TKDN
        foreach ($tkdnItems as $item) {
            $totalPrice = $item->calculateTotalPrice($volume, $duration);
            $subTotalHpp += $totalPrice;

            $items[] = [
                'code' => $item->code,
                'name' => $item->name,
                'classification' => $item->tkdn_classification,
                'volume' => $volume,
                'unit' => $item->unit,
                'duration' => $duration,
                'duration_unit' => 'Bulan',
                'unit_price' => $item->unit_price,
                'total_price' => $totalPrice,
            ];
        }

        // Hitung overhead
        $overhead = ($subTotalHpp * $overheadPercentage) / 100;

        // Hitung margin
        $margin = ($subTotalHpp * $marginPercentage) / 100;

        // Hitung sub total
        $subTotal = $subTotalHpp + $overhead + $margin;

        // Hitung PPN
        $ppn = ($subTotal * $ppnPercentage) / 100;

        // Hitung grand total
        $grandTotal = $subTotal + $ppn;

        return [
            'items' => $items,
            'sub_total_hpp' => $subTotalHpp,
            'overhead' => $overhead,
            'margin' => $margin,
            'sub_total' => $subTotal,
            'ppn' => $ppn,
            'grand_total' => $grandTotal,
        ];
    }

    public function print(Request $request)
    {
        $volume = $request->get('volume', 600);
        $duration = $request->get('duration', 12);
        $overheadPercentage = $request->get('overhead', 8);
        $marginPercentage = $request->get('margin', 12);
        $ppnPercentage = $request->get('ppn', 11);

        $tkdnItems = TkdnItem::active()->orderBy('tkdn_classification')->get();
        $breakdown = $this->calculateBreakdown($tkdnItems, $volume, $duration, $overheadPercentage, $marginPercentage, $ppnPercentage);

        return view('tkdn.print', compact('breakdown', 'volume', 'duration', 'overheadPercentage', 'marginPercentage', 'ppnPercentage'));
    }
}
