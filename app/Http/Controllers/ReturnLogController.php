<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReturnRequest;
use App\Models\ActivityLog;
use App\Models\Loan;
use App\Models\ReturnLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnLogController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $search = $request->input('search');
        $condition = $request->input('condition_on_return');

        $query = ReturnLog::with(['loan.user', 'loan.item']);

        if (! $user->isAdmin()) {
            $query->whereHas('loan', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        if ($condition) {
            $query->where('condition_on_return', $condition);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('loan.item', function ($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%");
                })->orWhereHas('loan.user', function ($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%");
                })->orWhere('notes', 'like', "%{$search}%");
            });
        }

        $returnLogs = $query->latest('returned_at')->latest('id')->paginate(10)->withQueryString();

        return view('return_logs.index', compact('returnLogs', 'search', 'condition'));
    }

    public function create(Request $request)
    {
        $selectedLoanId = $request->input('loan_id');

        // Only loans that have not been returned yet
        $loans = Loan::with(['user', 'item'])
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->latest('loan_date')
            ->get();

        $selectedLoan = $selectedLoanId ? Loan::with(['user', 'item'])->find($selectedLoanId) : null;

        return view('return_logs.create', compact('loans', 'selectedLoan', 'selectedLoanId'));
    }

    public function store(StoreReturnRequest $request)
    {
        $validated = $request->validated();

        $returnLog = DB::transaction(function () use ($validated) {
            $loan = Loan::with('item')->findOrFail($validated['loan_id']);

            // 1. Create return log
            $log = ReturnLog::create([
                'loan_id' => $loan->id,
                'returned_at' => $validated['returned_at'],
                'condition_on_return' => $validated['condition_on_return'],
                'notes' => $validated['notes'],
            ]);

            // 2. Mark loan as dikembalikan
            $loan->update(['status' => 'dikembalikan']);

            // 3. Restore item stock
            $loan->item->increment('stock', $loan->quantity);

            // 4. Update item condition if returned in worse state
            if ($validated['condition_on_return'] === 'rusak berat') {
                $loan->item->update(['condition' => 'rusak berat']);
            } elseif ($validated['condition_on_return'] === 'rusak ringan' && $loan->item->condition === 'baik') {
                $loan->item->update(['condition' => 'rusak ringan']);
            }

            return $log;
        });

        $returnLog->load(['loan.item', 'loan.user']);

        ActivityLog::record(
            auth()->id(),
            'verify_return',
            "Memverifikasi pengembalian barang '{$returnLog->loan->item->name}' ({$returnLog->loan->quantity} unit) dari {$returnLog->loan->user->name} dengan kondisi '{$returnLog->condition_on_return}'."
        );

        return redirect()->route('return_logs.index')
            ->with('success', 'Pengembalian barang berhasil diverifikasi dan dicatat!');
    }

    public function show(ReturnLog $returnLog)
    {
        $user = auth()->user();
        if (! $user->isAdmin() && $returnLog->loan->user_id !== $user->id) {
            abort(403, 'Akses ditolak.');
        }

        $returnLog->load(['loan.user', 'loan.item.category']);

        return view('return_logs.show', compact('returnLog'));
    }

    public function destroy(ReturnLog $returnLog)
    {
        if (! auth()->user()->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        $returnLog->delete();

        ActivityLog::record(
            auth()->id(),
            'delete_return_log',
            "Menghapus data log pengembalian #{$returnLog->id}."
        );

        return redirect()->route('return_logs.index')
            ->with('success', 'Catatan pengembalian berhasil dihapus!');
    }
}
