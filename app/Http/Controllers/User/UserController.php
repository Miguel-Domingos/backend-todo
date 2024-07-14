<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function getAll()
    {
        $data = User::get();
        if (!$data) {
            return Response::error("Nenhum usuário encontrado", 404);
        }
        return Response::success("lista de usuários", 200, ["data" => $data]);
    }

    public function getAllMinimal()
    {
        $data = User::select('id', 'name')->get();


        if (!$data) {
            return Response::error("Nenhum usuário encontrado", 404);
        }
        return Response::success("lista de usuários", 200, ["data" => $data]);
    }

    public function create(UserRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $response = User::create($data);
        if ($response) {
            return Response::success("usuário criado com sucesso", 200, ["data" => $response]);
        }
        return Response::error("erro ao criar criar usuário");
    }

    public function getAllUserTasks(int $id)
    {
        $data =  User::select('id', 'name')->where('id', $id)->with(['tasks', 'tasks.users:id,name'])->get()->map(function ($task) {
            $task->tasks->makeHidden('pivot');
            $task->tasks->map(function ($user) {
                $user->users->makeHidden('pivot');
                return $user;
            });
            return $task;
        });

        if (!$data) {
            return Response::error("Nenhum tarefa encontrada", 404);
        }
        return Response::success("lista de tarefas", 200, ["data" => $data]);
    }
}
