<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class NotificationModel extends Model
{
    use HasFactory;

    protected $table = 'notification';

    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function insertRecord($user_id, $url,  $message)
    {
        $save = new NotificationModel;
        $save->user_id = $user_id;
        $save->url = $url;
        $save->message = $message;
        $save->save();
    }

    static public function getRecord()
    {
        return NotificationModel::where('user_id', '=', 1)
            ->orderBy('id', 'desc')
            ->paginate(40);
    }

    static public function getRecordUser($user_id)
    {
        return NotificationModel::where('user_id', '=', $user_id)
            ->orderBy('id', 'desc')
            ->paginate(40);
    }
    static public function getUnreadNotification()
    {
        return NotificationModel::where('is_read', '=', 0)
            ->where('user_id', '=', 1)
            ->orderBy('id', 'desc')
            ->get();
    }

    static public function getUnreadNotificationCount($user_id)
    {
        return NotificationModel::where('is_read', '=', 0)
            ->where('user_id', '=', $user_id)
            ->orderBy('id', 'desc')
            ->count();
    }
    static public function updateReadNoti($id)
    {
        $getRecord = NotificationModel::getSingle($id);
        if (!empty($getRecord)) {
            $getRecord->is_read = 1;
            $getRecord->save();
        }
    }
}
