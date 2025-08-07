<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TKDN Breakdown - Print</title>
    <style>
        @media print {
            body { margin: 0; }
            .no-print { display: none !important; }
        }
        
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        
        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        
        .header p {
            margin: 5px 0;
            font-size: 12px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            font-size: 11px;
        }
        
        .tkdn-classification {
            background-color: #fef3cd;
            color: #856404;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        
        .subtotal-row {
            background-color: #e9ecef;
            font-weight: bold;
        }
        
        .grand-total {
            background-color: #d4edda;
            font-weight: bold;
            font-size: 14px;
        }
        
        .note {
            margin-top: 20px;
            padding: 10px;
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 4px;
            font-size: 11px;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 48px;
            color: rgba(0,0,0,0.1);
            z-index: -1;
            pointer-events: none;
        }
        
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        
        .print-button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="watermark">Page 1</div>
    
    <button class="print-button no-print" onclick="window.print()">Print</button>
    
    <div class="header">
        <h1>BREAKDOWN BIAYA TKDN</h1>
        <p>Layanan Pengelolaan Arsip</p>
        <p>Volume: {{ $volume }} Box | Durasi: {{ $duration }} Bulan</p>
        <p>Tanggal: {{ date('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">NO.</th>
                <th style="width: 35%">URAIAN BARANG/PEKERJAAN</th>
                <th style="width: 10%">Klasifikasi TKDN</th>
                <th style="width: 8%">VOLUME</th>
                <th style="width: 8%">SAT.</th>
                <th style="width: 8%">Durasi</th>
                <th style="width: 8%">Sat</th>
                <th style="width: 10%">HAR SAT.</th>
                <th style="width: 8%">JUMLAH HARGA</th>
            </tr>
        </thead>
        <tbody>
            @foreach($breakdown['items'] as $index => $item)
                <tr>
                    <td>{{ chr(65 + $index) }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>
                        <span class="tkdn-classification">{{ $item['classification'] }}</span>
                    </td>
                    <td style="text-align: right">{{ number_format($item['volume'], 2) }}</td>
                    <td>{{ $item['unit'] }}</td>
                    <td style="text-align: right">{{ $item['duration'] }}</td>
                    <td>{{ $item['duration_unit'] }}</td>
                    <td style="text-align: right">Rp {{ number_format($item['unit_price'], 0, ',', '.') }}</td>
                    <td style="text-align: right">Rp {{ number_format($item['total_price'], 0, ',', '.') }}</td>
                </tr>
            @endforeach

            <!-- SUB TOTAL HPP -->
            <tr class="subtotal-row">
                <td colspan="8">SUB TOTAL HPP</td>
                <td style="text-align: right">Rp {{ number_format($breakdown['sub_total_hpp'], 0, ',', '.') }}</td>
            </tr>

            <!-- Overhead -->
            <tr class="subtotal-row">
                <td>VI</td>
                <td>Overhead</td>
                <td>{{ $overheadPercentage }}%</td>
                <td colspan="5"></td>
                <td style="text-align: right">Rp {{ number_format($breakdown['overhead'], 0, ',', '.') }}</td>
            </tr>

            <!-- Margin -->
            <tr class="subtotal-row">
                <td>VII</td>
                <td>Margin</td>
                <td>{{ $marginPercentage }}%</td>
                <td colspan="5"></td>
                <td style="text-align: right">Rp {{ number_format($breakdown['margin'], 0, ',', '.') }}</td>
            </tr>

            <!-- SUB TOTAL -->
            <tr class="subtotal-row">
                <td colspan="8">SUB TOTAL</td>
                <td style="text-align: right">Rp {{ number_format($breakdown['sub_total'], 0, ',', '.') }}</td>
            </tr>

            <!-- PPN -->
            <tr class="subtotal-row">
                <td colspan="7"></td>
                <td>PPN</td>
                <td style="text-align: right">{{ $ppnPercentage }}%</td>
                <td style="text-align: right">Rp {{ number_format($breakdown['ppn'], 0, ',', '.') }}</td>
            </tr>

            <!-- GRAND TOTAL -->
            <tr class="grand-total">
                <td colspan="8">GRAND TOTAL</td>
                <td style="text-align: right">Rp {{ number_format($breakdown['grand_total'], 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="note">
        <strong>Note:</strong> Setiap Bulan Maksimal Volume {{ $volume }} {{ $breakdown['items'][0]['unit'] ?? 'Box' }}, jika melebihi maka ditagihkan additional
    </div>

    <div style="margin-top: 30px; page-break-inside: avoid;">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 50%; border: none; vertical-align: top;">
                    <p><strong>Dibuat oleh:</strong></p>
                    <br><br><br>
                    <p>_______________________</p>
                    <p>Staff TKDN</p>
                </td>
                <td style="width: 50%; border: none; vertical-align: top;">
                    <p><strong>Disetujui oleh:</strong></p>
                    <br><br><br>
                    <p>_______________________</p>
                    <p>Manager</p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
