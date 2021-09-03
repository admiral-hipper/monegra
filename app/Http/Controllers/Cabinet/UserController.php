<?php

namespace App\Http\Controllers\Cabinet;

use Illuminate\Http\{Request, JsonResponse};
use Illuminate\Support\Facades\DB;

class UserController
{
    /**
     * Получить уведомления пользователя
     *
     * @return JsonResponse
     */
    public function getNotifications(): JsonResponse
    {
        $pagination = \Auth::user()
            ->notifications()
            ->select('id', 'data', 'read_at', 'created_at')
            ->simplePaginate(10);

        $countOfUnread = \Auth::user()
            ->unreadNotifications
            ->count();

        return response()->json([
            'count_of_unread' => $countOfUnread,
            'notifications' => $pagination->items(),
            'current_page' => $pagination->currentPage(),
            'has_more' => $pagination->hasMorePages(),
        ]);
    }

    /**
     * Прочитать уведомления пользователя
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function bulkReadNotifications(Request $request): JsonResponse
    {
        $requestData = $request->validate([
            'notification_ids' => 'required|array|min:1',
        ]);

        $notifications = \Auth::user()
            ->notifications
            ->whereIn('id', $requestData['notification_ids']);

        if ($notifications->count()) {
            $notifications->markAsRead();
        }

        $countOfUnread = \Auth::user()
            ->unreadNotifications
            ->count();

        return response()->json(['count_of_unread' => $countOfUnread]);
    }
}
