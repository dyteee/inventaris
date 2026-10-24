<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanRequest;
use App\Models\ActivityLog;
use App\Models\Item;
use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Update any overdue loans
        Loan::where('status', 'dipinjam')
            ->whereDate('due_date', '<', Carbon::today())
            ->update(['status' => 'terlambat']);

        $search = $request->input('search');
        $status = $request->input('status');
        $userId = $request->input('user_id');

        $query = Loan::with(['user', 'item', 'returnLog']);

        if (! $user->isAdmin()) {
            // Regular user only sees their own loans
            $query->where('user_id', $user->id);
        } else {
            if ($userId) {
                $query->where('user_id', $userId);
            }
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('item', function ($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%");
                })->orWhereHas('user', function ($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%");
                });
            });
        }

        $loans = $query->latest('loan_date')->latest('id')->paginate(10)->withQueryString();
        $users = $user->isAdmin() ? User::orderBy('name')->get() : collect();

        return view('loans.index', compact('loans', 'search', 'status', 'userId', 'users'));
    }

    public function create(Request $request)
    {
        $selectedItemId = $request->input('item_id');
        $items = Item::where('stock', '>', 0)->orderBy('name')->get();
        $users = auth()->user()->isAdmin() ? User::where('role', 'user')->orderBy('name')->get() : collect();

        return view('loans.create', compact('items', 'users', 'selectedItemId'));
    }

    public function store(StoreLoanRequest $request)
    {
        $validated = $request->validated();
        $currentUser = $request->user();

        $borrowerId = $currentUser->isAdmin() && isset($validated['user_id'])
            ? (int) $validated['user_id']
            : $currentUser->id;

        $loan = DB::transaction(function () use ($validated, $borrowerId) {
            $item = Item::findOrFail($validated['item_id']);

            // Deduct stock
            $item->decrement('stock', $validated['quantity']);

            return Loan::create([
                'user_id' => $borrowerId,
                'item_id' => $item->id,
                'quantity' => $validated['quantity'],
                'loan_date' => $validated['loan_date'],
                'due_date' => $validated['due_date'],
                'status' => 'dipinjam',
            ]);
        });

        $borrower = User::find($borrowerId);
        $item = Item::find($loan->item_id);

        ActivityLog::record(
            $currentUser->id,
            'create_loan',
            "Mencatat peminjaman barang '{$item->name}' ({$item->code}) sejumlah {$loan->quantity} unit untuk {$borrower->name} hingga {$loan->due_date->format('d/m/Y')}."
        );

        return redirect()->route('loans.index')
            ->with('success', 'Peminjaman barang berhasil diajukan dan dicatat!');
    }

    public function show(Loan $loan)
    {
        $user = auth()->user();
        if (! $user->isAdmin() && $loan->user_id !== $user->id) {
            abort(403, 'Akses ditolak.');
        }

        $loan->load(['user', 'item.category', 'returnLog']);

        return view('loans.show', compact('loan'));
    }

    public function destroy(Loan $loan)
    {
        if (! auth()->user()->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        DB::transaction(function () use ($loan) {
            // If loan was still active, restore item stock
            if (in_array($loan->status, ['dipinjam', 'terlambat'])) {
                $loan->item->increment('stock', $loan->quantity);
            }

            $loan->delete();
        });

        ActivityLog::record(
            auth()->id(),
            'delete_loan',
            "Menghapus riwayat peminjaman #{$loan->id} ({$loan->item->name} oleh {$loan->user->name})."
        );

        return redirect()->route('loans.index')
            ->with('success', 'Data peminjaman berhasil dihapus!');
    }
}
