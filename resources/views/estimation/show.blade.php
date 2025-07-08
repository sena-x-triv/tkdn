@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Detail Estimasi</h1>
    <p class="text-gray-600 dark:text-gray-400">Lihat detail estimasi dan item-itemnya di bawah ini.</p>
</div>
@if(session('status'))
    <div class="mb-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    </div>
@endif
<div class="card max-w-3xl mx-auto mb-8">
    <div class="card-body space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <div class="text-gray-500 dark:text-gray-400 text-sm">Kode Estimasi</div>
                <div class="font-semibold text-gray-900 dark:text-white">{{ $estimation->code ?? '-' }}</div>
            </div>
            <div>
                <div class="text-gray-500 dark:text-gray-400 text-sm">Judul Estimasi</div>
                <div class="font-semibold text-gray-900 dark:text-white">{{ $estimation->title }}</div>
            </div>
            <div>
                <div class="text-gray-500 dark:text-gray-400 text-sm">Total</div>
                <div class="font-semibold text-gray-900 dark:text-white">Rp {{ number_format($estimation->total,0,',','.') }}</div>
            </div>
            <div>
                <div class="text-gray-500 dark:text-gray-400 text-sm">Margin</div>
                <div class="font-semibold text-gray-900 dark:text-white">{{ number_format($estimation->margin,0,',','.') }} %</div>
            </div>
            <div>
                <div class="text-gray-500 dark:text-gray-400 text-sm">Harga Satuan</div>
                <div class="font-semibold text-gray-900 dark:text-white">Rp {{ number_format($estimation->total_unit_price,0,',','.') }}</div>
            </div>
        </div>
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Item Estimasi</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-2 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Kategori</th>
                            <th class="px-2 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Kode</th>
                            <th class="px-2 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Nama/Peralatan</th>
                            <th class="px-2 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Koefisien</th>
                            <th class="px-2 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Harga Satuan</th>
                            <th class="px-2 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Jumlah Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($estimation->items as $item)
                        <tr>
                            <td class="px-2 py-2">{{ ucfirst($item->category) }}</td>
                            <td class="px-2 py-2">{{ $item->code }}</td>
                            <td class="px-2 py-2">{{ $item->equipment_name }}</td>
                            <td class="px-2 py-2">{{ $item->coefficient }}</td>
                            <td class="px-2 py-2">Rp {{ number_format($item->unit_price,0,',','.') }}</td>
                            <td class="px-2 py-2">Rp {{ number_format($item->total_price,0,',','.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-2 py-2 text-center text-gray-500 dark:text-gray-400">Belum ada item.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <a href="{{ route('master.estimation.index') }}" class="btn btn-secondary">Kembali ke Daftar Estimasi</a>
            <a href="{{ route('master.estimation.edit', $estimation->id) }}" class="btn btn-primary ml-2">Edit Estimasi</a>
        </div>
    </div>
</div>
@endsection 