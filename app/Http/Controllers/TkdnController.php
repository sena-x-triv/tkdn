<?php

namespace App\Http\Controllers;

use App\Models\TkdnItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TkdnController extends Controller
{
    public function index(Request $request)
    {
        $query = TkdnItem::query();

        // Filter berdasarkan klasifikasi TKDN
        if ($request->filled('classification')) {
            $query->byClassification($request->classification);
        }

        // Filter berdasarkan status aktif
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        // Search berdasarkan nama atau kode
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        $tkdnItems = $query->latest()->paginate(10);
        $classifications = TkdnItem::distinct()->pluck('tkdn_classification')->sort();

        return view('tkdn.index', compact('tkdnItems', 'classifications'));
    }

    public function create()
    {
        $classifications = ['3.1', '3.2', '3.3', '3.4'];
        return view('tkdn.create', compact('classifications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:tkdn_items,code',
            'name' => 'required|string|max:255',
            'tkdn_classification' => 'required|string|in:3.1,3.2,3.3,3.4',
            'unit' => 'required|string|max:50',
            'unit_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->all();
            $data['is_active'] = $request->has('is_active');

            TkdnItem::create($data);

            DB::commit();
            return redirect()->route('master.tkdn.index')->with('status', 'Item TKDN berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function show(TkdnItem $tkdnItem)
    {
        return view('tkdn.show', compact('tkdnItem'));
    }

    public function edit(TkdnItem $tkdnItem)
    {
        $classifications = ['3.1', '3.2', '3.3', '3.4'];
        return view('tkdn.edit', compact('tkdnItem', 'classifications'));
    }

    public function update(Request $request, TkdnItem $tkdnItem)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:tkdn_items,code,' . $tkdnItem->id,
            'name' => 'required|string|max:255',
            'tkdn_classification' => 'required|string|in:3.1,3.2,3.3,3.4',
            'unit' => 'required|string|max:50',
            'unit_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->all();
            $data['is_active'] = $request->has('is_active');

            $tkdnItem->update($data);

            DB::commit();
            return redirect()->route('master.tkdn.show', $tkdnItem->id)->with('status', 'Item TKDN berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(TkdnItem $tkdnItem)
    {
        try {
            $tkdnItem->delete();
            return redirect()->route('master.tkdn.index')->with('status', 'Item TKDN berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Toggle status aktif/nonaktif
     */
    public function toggleStatus(TkdnItem $tkdnItem)
    {
        try {
            $tkdnItem->update(['is_active' => !$tkdnItem->is_active]);
            $status = $tkdnItem->is_active ? 'diaktifkan' : 'dinonaktifkan';
            return back()->with('status', "Item TKDN berhasil {$status}!");
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
