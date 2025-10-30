<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SendNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $notifications = SendNotification::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return response()->json([
            'success' => true,
            'notifications' => $notifications
        ]);
    }
    
    public function markAsRead(Request $request, $id)
    {
        $notification = SendNotification::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();
            
        if ($notification) {
            $notification->is_read = true;
            $notification->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Notification marked as read'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Notification not found'
        ], 404);
    }
}
