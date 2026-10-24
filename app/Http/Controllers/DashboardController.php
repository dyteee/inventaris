<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\Item;
use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user() ?? auth()->user();

        // Automatically update overdue loans status
        Loan::where('status', 'dipinjam')
            ->whereDate('due_date', '<', Carbon::today())
            ->update(['status' => 'terlambat']);

        if ($user->isAdmin()) {
            $totalCategories = Category::count();
            $totalItems = Item::count();
            $totalStockPhysical = Item::sum('stock');
            $totalUsers = User::count();
            $activeLoans = Loan::where('status', 'dipinjam')->count();
            $lateLoans = Loan::where('status', 'terlambat')->count();
            $returnedLoans = Loan::where('status', 'dikembalikan')->count();

            $conditionStats = [
                'baik' => Item::where('condition', 'baik')->sum('stock'),
                'rusak_ringan' => Item::where('condition', 'rusak ringan')->sum('stock'),
                'rusak_berat' => Item::where('condition', 'rusak berat')->sum('stock'),
            ];

            $recentLoans = Loan::with(['user', 'item.category'])
                ->latest()
                ->take(6)
                ->get();

            $recentActivities = ActivityLog::with('user')
                ->latest()
                ->take(6)
                ->get();

            $lowStockItems = Item::with('category')
                ->where('stock', '<=', 2)
                ->take(5)
                ->get();

            return view('dashboard', compact(
                'totalCategories',
                'totalItems',
                'totalStockPhysical',
                'totalUsers',
                'activeLoans',
                'lateLoans',
                'returnedLoans',
                'conditionStats',
                'recentLoans',
                'recentActivities',
                'lowStockItems'
            ));
        }

        // For Regular User (Guru / Siswa)
        $myActiveLoans = Loan::with('item.category')
            ->where('user_id', $user->id)
            ->where('status', 'dipinjam')
            ->get();

        $myLateLoans = Loan::with('item.category')
            ->where('user_id', $user->id)
            ->where('status', 'terlambat')
            ->get();

        $myTotalLoansCount = Loan::where('user_id', $user->id)->count();
        $myReturnedCount = Loan::where('user_id', $user->id)->where('status', 'dikembalikan')->count();

        $availableItems = Item::with('category')
            ->where('stock', '>', 0)
            ->latest()
            ->take(6)
            ->get();

        return view('dashboard', compact(
            'myActiveLoans',
            'myLateLoans',
            'myTotalLoansCount',
            'myReturnedCount',
            'availableItems'
        ));
    }
}
