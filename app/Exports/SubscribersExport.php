<?php

namespace App\Exports;

use App\Models\Subscriber;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SubscribersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Subscriber::select('full_name', 'email', 'phone' , 'created_at')
            ->get()
            ->map(function ($item) {
                return [
                    'full_name'     => $item->full_name,
                    'email'         => $item->email,
                    'phone'         => $item->phone,
                    'subscribed_at' => Carbon::parse($item->created_at)->format('d M Y g:ia'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Full Name',
            'Email',
            'Phone',
            'Subscribed At',
        ];
    }
}
