<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');
        $condition = $request->input('condition');
        $location = $request->input('location');
        $stockStatus = $request->input('stock_status');

        $query = Item::with('category');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($condition) {
            $query->where('condition', $condition);
        }

        if ($location) {
            $query->where('location', $location);
        }

        if ($stockStatus === 'available') {
            $query->where('stock', '>', 0);
        } elseif ($stockStatus === 'empty') {
            $query->where('stock', '<=', 0);
        }

        $items = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();
        $locations = Item::select('location')
            ->whereNotNull('location')
            ->where('location', '!=', '')
            ->distinct()
            ->orderBy('location')
            ->pluck('location');

        return view('items.index', compact('items', 'categories', 'locations', 'search', 'categoryId', 'condition', 'location', 'stockStatus'));
    }

    public function show(Item $item)
    {
        $item->load(['category', 'loans' => function ($q) {
            $q->with('user')->latest()->take(5);
        }]);

        return view('items.show', compact('item'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $locations = Item::select('location')
            ->whereNotNull('location')
            ->where('location', '!=', '')
            ->distinct()
            ->orderBy('location')
            ->pluck('location');

        return view('items.create', compact('categories', 'locations'));
    }

    public function store(StoreItemRequest $request)
    {
        $item = Item::create($request->validated());

        ActivityLog::record(
            auth()->id(),
            'create_item',
            "Menambahkan barang baru: '{$item->name}' ({$item->code}) penempatan di {$item->location} dengan stok {$item->stock} unit."
        );

        return redirect()->route('items.index')
            ->with('success', 'Barang inventaris berhasil ditambahkan!');
    }

    public function edit(Item $item)
    {
        $categories = Category::orderBy('name')->get();
        $locations = Item::select('location')
            ->whereNotNull('location')
            ->where('location', '!=', '')
            ->distinct()
            ->orderBy('location')
            ->pluck('location');

        return view('items.edit', compact('item', 'categories', 'locations'));
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update($request->validated());

        ActivityLog::record(
            auth()->id(),
            'update_item',
            "Memperbarui data barang: '{$item->name}' ({$item->code})."
        );

        return redirect()->route('items.index')
            ->with('success', 'Data barang inventaris berhasil diperbarui!');
    }

    public function destroy(Item $item)
    {
        // Check if there are active loans
        $hasActiveLoans = $item->loans()
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->exists();

        if ($hasActiveLoans) {
            return redirect()->route('items.index')
                ->with('error', 'Barang tidak dapat dihapus karena masih ada transaksi peminjaman aktif!');
        }

        $itemName = $item->name;
        $itemCode = $item->code;
        $item->delete();

        ActivityLog::record(
            auth()->id(),
            'delete_item',
            "Menghapus data barang: '{$itemName}' ({$itemCode})."
        );

        return redirect()->route('items.index')
            ->with('success', 'Barang inventaris berhasil dihapus!');
    }
}

