<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskRequest;
use App\Http\Response;
use App\Models\Task;
use App\Models\UserTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function getAll()
    {
        $data = Task::with(['users:id,name'])->get()->map(function ($task) {
            $task->users->makeHidden('pivot');
            return $task;
        });

        if (!$data) {
            return Response::error("Nenhuma tarefa encontrada", 404);
        }
        return Response::success("lista de tarefas", 200, ["data" => $data]);
    }

    public function create(TaskRequest $request)
    {
        try {
            $data = $request->all();
            DB::beginTransaction();
            $TaskResponse = Task::create($data);

            foreach ($data['users_id'] as $id_user) {
                UserTask::create([
                    'user_id' => $id_user,
                    'task_id' => $TaskResponse->id,
                ]);
            }
            DB::commit();
            return Response::success("tarefa criada com sucesso", 200, ["data" => $TaskResponse]);
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::error("Erro ao cadastrar tarefa", 500);
        }
    }

    public function delete(Task $task)
    {
        try {
            DB::beginTransaction();
            UserTask::where("task_id", $task->id)->delete();
            Task::find($task->id)->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::error("Erro ao cadastrar tarefa", 500);
        }
        return Response::success("tarefa deletada com sucesso", 200, ["data" => []]);
    }

    public function update(TaskRequest $request, Task $task)
    {
        try {
            $data = $request->all();

            DB::beginTransaction();
            Task::find($task->id)->update($data);
            UserTask::where("task_id", $task->id)->delete();

            foreach ($data['users_id'] as $id_user) {
                UserTask::create([
                    'user_id' => $id_user,
                    'task_id' => $task->id,
                ]);
            }
            DB::commit();
            return Response::success("tarefa deletada com sucesso", 200, ["data" => []]);
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::error("Erro ao atualizar tarefa", 500);
        }
    }
}
