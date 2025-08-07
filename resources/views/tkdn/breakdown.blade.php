@extends('layouts.app')

@section('title', 'TKDN Breakdown')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">TKDN Breakdown</h1>
        <div class="flex space-x-2">
            <a href="{{ route('master.tkdn.breakdown.print') }}?volume={{ $volume }}&duration={{ $duration }}&overhead={{ $overheadPercentage }}&margin={{ $marginPercentage }}&ppn={{ $ppnPercentage }}" 
               target="_blank"
               class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                <i class="fas fa-print mr-2"></i>Print
            </a>
            <a href="{{ route('master.tkdn.index') }}" 
               class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Parameter Form -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Parameter Perhitungan</h2>
        <form method="GET" action="{{ route('master.tkdn.breakdown') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label for="volume" class="block text-sm font-medium text-gray-700 mb-2">Volume</label>
                <input type="number" name="volume" id="volume" value="{{ $volume }}" min="1"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Durasi (Bulan)</label>
                <input type="number" name="duration" id="duration" value="{{ $duration }}" min="1"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label for="overhead" class="block text-sm font-medium text-gray-700 mb-2">Overhead (%)</label>
                <input type="number" name="overhead" id="overhead" value="{{ $overheadPercentage }}" min="0" max="100" step="0.1"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label for="margin" class="block text-sm font-medium text-gray-700 mb-2">Margin (%)</label>
                <input type="number" name="margin" id="margin" value="{{ $marginPercentage }}" min="0" max="100" step="0.1"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-calculator mr-2"></i>Hitung
                </button>
            </div>
        </form>
    </div>

    <!-- Breakdown Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NO.</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URAIAN BARANG/PEKERJAAN</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-yellow-100">Klasifikasi TKDN</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">VOLUME</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SAT.</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sat</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">HAR SAT.</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">JUMLAH HARGA</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($breakdown['items'] as $index => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                {{ chr(65 + $index) }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $item['name'] }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    {{ $item['classification'] }}
                                </span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                {{ number_format($item['volume'], 2) }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                {{ $item['unit'] }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                {{ $item['duration'] }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                {{ $item['duration_unit'] }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                Rp {{ number_format($item['unit_price'], 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                Rp {{ number_format($item['total_price'], 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach

                    <!-- SUB TOTAL HPP -->
                    <tr class="bg-gray-100">
                        <td colspan="8" class="px-4 py-3 text-sm font-medium text-gray-900">
                            SUB TOTAL HPP
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900">
                            Rp {{ number_format($breakdown['sub_total_hpp'], 0, ',', '.') }}
                        </td>
                    </tr>

                    <!-- Overhead -->
                    <tr class="bg-gray-100">
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            VI
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900">
                            Overhead
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            {{ $overheadPercentage }}%
                        </td>
                        <td colspan="5" class="px-4 py-3 text-sm text-gray-900">
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                            Rp {{ number_format($breakdown['overhead'], 0, ',', '.') }}
                        </td>
                    </tr>

                    <!-- Margin -->
                    <tr class="bg-gray-100">
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            VII
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900">
                            Margin
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            {{ $marginPercentage }}%
                        </td>
                        <td colspan="5" class="px-4 py-3 text-sm text-gray-900">
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                            Rp {{ number_format($breakdown['margin'], 0, ',', '.') }}
                        </td>
                    </tr>

                    <!-- SUB TOTAL -->
                    <tr class="bg-gray-100">
                        <td colspan="8" class="px-4 py-3 text-sm font-medium text-gray-900">
                            SUB TOTAL
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900">
                            Rp {{ number_format($breakdown['sub_total'], 0, ',', '.') }}
                        </td>
                    </tr>

                    <!-- PPN -->
                    <tr class="bg-gray-100">
                        <td colspan="7" class="px-4 py-3 text-sm text-gray-900">
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            PPN
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $ppnPercentage }}%
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                            Rp {{ number_format($breakdown['ppn'], 0, ',', '.') }}
                        </td>
                    </tr>

                    <!-- GRAND TOTAL -->
                    <tr class="bg-gray-100">
                        <td colspan="8" class="px-4 py-3 text-sm font-bold text-gray-900">
                            GRAND TOTAL
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-lg font-bold text-green-600">
                            Rp {{ number_format($breakdown['grand_total'], 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Note -->
    <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
        <p class="text-sm text-yellow-800">
            <strong>Note:</strong> Setiap Bulan Maksimal Volume {{ $volume }} {{ $breakdown['items'][0]['unit'] ?? 'Box' }}, jika melebihi maka ditagihkan additional
        </p>
    </div>
</div>
@endsection
