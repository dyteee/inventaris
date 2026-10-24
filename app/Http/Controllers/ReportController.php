<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->input('type', 'items'); // 'items' or 'loans'
        
        // Item Filters
        $categoryId = $request->input('category_id');
        $condition = $request->input('condition');
        $location = $request->input('location');
        
        // Loan Filters
        $status = $request->input('status');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Summary metrics
        $totalItemsCount = Item::count();
        $totalStockSum = Item::sum('stock');
        $goodConditionCount = Item::where('condition', 'baik')->sum('stock');
        $lightDamageCount = Item::where('condition', 'rusak ringan')->sum('stock');
        $heavyDamageCount = Item::where('condition', 'rusak berat')->sum('stock');

        $activeLoansCount = Loan::where('status', 'dipinjam')->count();
        $overdueLoansCount = Loan::where('status', 'terlambat')->count();
        $returnedLoansCount = Loan::where('status', 'dikembalikan')->count();

        // Items Query
        $itemsQuery = Item::with('category');
        if ($categoryId) {
            $itemsQuery->where('category_id', $categoryId);
        }
        if ($condition) {
            $itemsQuery->where('condition', $condition);
        }
        if ($location) {
            $itemsQuery->where('location', $location);
        }
        $items = $itemsQuery->orderBy('code')->get();

        // Loans Query
        $loansQuery = Loan::with(['user', 'item.category']);
        if ($status) {
            $loansQuery->where('status', $status);
        }
        if ($startDate) {
            $loansQuery->whereDate('loan_date', '>=', $startDate);
        }
        if ($endDate) {
            $loansQuery->whereDate('loan_date', '<=', $endDate);
        }
        $loans = $loansQuery->latest()->get();

        $categories = Category::orderBy('name')->get();
        $locations = Item::select('location')->whereNotNull('location')->where('location', '!=', '')->distinct()->pluck('location');

        return view('reports.index', compact(
            'type',
            'items',
            'loans',
            'categories',
            'locations',
            'categoryId',
            'condition',
            'location',
            'status',
            'startDate',
            'endDate',
            'totalItemsCount',
            'totalStockSum',
            'goodConditionCount',
            'lightDamageCount',
            'heavyDamageCount',
            'activeLoansCount',
            'overdueLoansCount',
            'returnedLoansCount'
        ));
    }

    public function print(Request $request)
    {
        $type = $request->input('type', 'items');
        $categoryId = $request->input('category_id');
        $condition = $request->input('condition');
        $location = $request->input('location');
        $status = $request->input('status');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($type === 'items') {
            $query = Item::with('category');
            if ($categoryId) $query->where('category_id', $categoryId);
            if ($condition) $query->where('condition', $condition);
            if ($location) $query->where('location', $location);
            $data = $query->orderBy('code')->get();

            return view('reports.print_items', compact('data', 'categoryId', 'condition', 'location'));
        }

        $query = Loan::with(['user', 'item.category']);
        if ($status) $query->where('status', $status);
        if ($startDate) $query->whereDate('loan_date', '>=', $startDate);
        if ($endDate) $query->whereDate('loan_date', '<=', $endDate);
        $data = $query->orderBy('loan_date', 'desc')->get();

        return view('reports.print_loans', compact('data', 'status', 'startDate', 'endDate'));
    }

    public function exportItems(Request $request)
    {
        $categoryId = $request->input('category_id');
        $condition = $request->input('condition');
        $location = $request->input('location');

        $query = Item::with('category');
        if ($categoryId) $query->where('category_id', $categoryId);
        if ($condition) $query->where('condition', $condition);
        if ($location) $query->where('location', $location);
        $items = $query->orderBy('code')->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="Laporan_Inventaris_Aset_Sekolah_'.date('Ymd_His').'.csv"',
        ];

        return new StreamedResponse(function () use ($items) {
            $handle = fopen('php://output', 'w');
            // Write UTF-8 BOM for Microsoft Excel compatibility
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($handle, ['No', 'Kode Barang', 'Nama Barang', 'Kategori', 'Stok Unit', 'Kondisi', 'Ruang/Lokasi', 'Sumber Dana', 'Tahun Perolehan', 'Keterangan']);

            $no = 1;
            foreach ($items as $item) {
                fputcsv($handle, [
                    $no++,
                    $item->code,
                    $item->name,
                    $item->category->name ?? '-',
                    $item->stock,
                    ucfirst($item->condition),
                    $item->location ?? '-',
                    $item->source_fund ?? '-',
                    $item->procurement_year ?? '-',
                    $item->description ?? '-',
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }

    public function exportLoans(Request $request)
    {
        $status = $request->input('status');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Loan::with(['user', 'item.category']);
        if ($status) $query->where('status', $status);
        if ($startDate) $query->whereDate('loan_date', '>=', $startDate);
        if ($endDate) $query->whereDate('loan_date', '<=', $endDate);
        $loans = $query->orderBy('loan_date', 'desc')->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="Laporan_Peminjaman_Inventaris_'.date('Ymd_His').'.csv"',
        ];

        return new StreamedResponse(function () use ($loans) {
            $handle = fopen('php://output', 'w');
            // UTF-8 BOM
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($handle, ['No', 'ID Pinjam', 'Peminjam', 'Kode Barang', 'Nama Barang', 'Jumlah Unit', 'Tgl Pinjam', 'Batas Kembali', 'Status']);

            $no = 1;
            foreach ($loans as $loan) {
                fputcsv($handle, [
                    $no++,
                    '#TRX-'.$loan->id,
                    $loan->user->name ?? '-',
                    $loan->item->code ?? '-',
                    $loan->item->name ?? '-',
                    $loan->quantity,
                    Carbon::parse($loan->loan_date)->translatedFormat('d F Y'),
                    Carbon::parse($loan->due_date)->translatedFormat('d F Y'),
                    ucfirst($loan->status),
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }
}
