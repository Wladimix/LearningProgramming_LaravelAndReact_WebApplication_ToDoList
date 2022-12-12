<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;


class TaskController extends Controller
{
    public function greeting()
    {
        return view('tasks');
    }

    public function getTasks($userId)
    {
        $tasks = DB::table('tasks')
            ->join('users', 'tasks.responsible_id', '=', 'users.id')
            ->select('tasks.*', 'users.name as responsible')
            ->where('creator_id', $userId)
            ->orWhere('responsible_id', $userId)
            ->get();

        $subordinates = DB::table('users')->where('leader_id', $userId)->get();

        $data = [
            'tasks'        => $tasks,
            'subordinates' => $subordinates
        ];
        
        return response()->json($data, 200);
    }

    public function addTask(Request $request)
    {
        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    public function updateTask(Request $request, $taskId)
    {
        $task = Task::where('id', $taskId)->update($request->all());
        return response()->json($task, 204);
    }

    public function deleteTask($taskId)
    {
        $task = DB::table('tasks')->where('id', $taskId)->delete();
        return response()->json($task, 204);
    }
}
