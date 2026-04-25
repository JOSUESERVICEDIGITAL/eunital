<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Models\Innovation\SuiviNotification;

class SuiviNotificationController extends Controller
{
    public function index()
    {
        $notifications = SuiviNotification::latest()->paginate(15);

        return view('back.innovations.suivi-notifications.index', compact('notifications'));
    }

    public function marquerLue(SuiviNotification $notification)
    {
        $notification->update(['lu' => true]);

        return back();
    }
}
