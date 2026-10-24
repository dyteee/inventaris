<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $action = $request->input('action');
        $userId = $request->input('user_id');

        $query = ActivityLog::with('user');

        if ($search) {
            $query->where('description', 'like', "%{$search}%");
        }

        if ($action) {
            $query->where('action', $action);
        }

        if ($userId) {
            $query->where('user_id', $userId);
        }

        $activityLogs = $query->latest('id')->paginate(15)->withQueryString();
        $logs = $activityLogs;
        $users = User::orderBy('name')->get();

        $actions = ActivityLog::select('action')->distinct()->pluck('action');

        return view('activity_logs.index', compact('activityLogs', 'logs', 'users', 'actions', 'search', 'action', 'userId'));
    }
}
