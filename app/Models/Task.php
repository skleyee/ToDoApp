<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use HasFactory;

    public static function getTasksForUser($user_id) {
        return DB::table('tasks')->where('user_id', $user_id)->get();
    }

    public static function deleteTaskById($task_id) {
        return DB::table('tasks')->where('id', $task_id)->delete();
    }

    public static function addTaskForUser($user_id, $description) {
        $query = DB::table('tasks')->insert([
            'user_id' => $user_id,
            'description' => $description,
            'its_done' => 0
        ]);
        if ($query) {
            return self::getTaskByDescription($description);
        }
    }
    public static function getTaskByDescription($description) {
        return DB::table('tasks')->where('description', $description)->get();
    }

    public static function editTaskDescriptionById($id, $new_descr) {
        return DB::table('tasks')->where('id', $id)->update(['description' => $new_descr]);
    }
}
