<?php

namespace App\Http\Controllers;

use App\Models\NotificationLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationLogController extends Controller
{
    public function index(): JsonResponse {
        $logs = NotificationLog::with('order')
            ->where('user_id', request()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json($logs);
    }
}
