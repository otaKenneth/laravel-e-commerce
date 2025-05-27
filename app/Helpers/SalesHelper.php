<?php
namespace App\Helpers;

use Carbon\Carbon;

class SalesHelper{

public function getFridayToThursdayRanges()
{
    $startDate = Carbon::parse('2024-05-31')->startOfWeek(Carbon::FRIDAY); // First Friday on/after July 1
    $endDate = Carbon::now()->endOfDay();

    $ranges = [];

    while ($startDate->lte($endDate)) {
        $rangeStart = $startDate->copy();
        $rangeEnd = $startDate->copy()->addDays(6); // Thursday

        $ranges[] = [
            'label' => $rangeStart->format('d M') . ' - ' . $rangeEnd->format('d M Y'),
            'from' => $rangeStart->format('Y-m-d'),
            'to' => $rangeEnd->format('Y-m-d'),
        ];

        $startDate->addWeek(); // move to next Friday
    }

    return $ranges;
}
}