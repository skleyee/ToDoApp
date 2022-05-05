<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $user_id = 3;
        $tasks = Task::getTasksForUser($user_id);
        return view('main', ['tasks' => $tasks]);
    }

    public function deleteTask(Request $req) {
        $req = $req->all();
        Task::deleteTaskById($req['id']);
    }

    public function addTask(Request $req) {
        $user_id = 3;
        $req = $req->all();
        return Task::addTaskForUser($user_id, $req['description']);

    }

    public function editTask(Request $req) {
        $req = $req->all();
        Task::editTaskDescriptionById($req['id'], $req['description']);
        return true;
    }
}
