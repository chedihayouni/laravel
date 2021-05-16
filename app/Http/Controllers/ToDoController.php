<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use App\Transformers\ToDoTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;

class ToDoController extends Controller
{
    /**
     * Get done todos by user.
     *
     * @return JsonResponse
     */
    public function getAllDone()
    {
        $doneTodos =  ToDo::all()
            ->where('status','=','DONE')
            ->where('user_id','=',auth()->user()->id);

        $resource = new Collection($doneTodos, new ToDoTransformer());
        $output = $this->manager->createData($resource)->toArray();

        return response()->json($output, 200);
    }

    /**
     * Get pending todos by user.
     *
     * @return JsonResponse
     */
    public function getAllPending()
    {
        $pendingTodos =  ToDo::all()
            ->where('status','=','PENDING')
            ->where('user_id','=',auth()->user()->id);

        $resource = new Collection($pendingTodos, new ToDoTransformer());
        $output = $this->manager->createData($resource)->toArray();

        return response()->json($output, 200);
    }

    /**
     * Add new todo.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required',
        ]);

        $content = $request->all();
        $content['user_id'] = auth()->user()->id;
        $content['status'] =  'PENDING';

        $toDo = ToDo::create($content);

        $resource = new Item($toDo, new ToDoTransformer());
        $output = $this->manager->createData($resource)->toArray();

        return response()->json($output, 201);
    }

    /**
     * Get one todo
     *
     * @param $id
     * @return JsonResponse
     */
    public function getOne($id)
    {
        try {
            $toDo = ToDo::findOrFail($id);
            $resource = new Item($toDo, new ToDoTransformer());
            $output = $this->manager->createData($resource)->toArray();

            return response()->json($output, 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>'todo not found!'], 404);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $toDo = ToDo::findOrFail($id);
            $toDo->update($request->all());

            $resource = new Item($toDo, new ToDoTransformer());
            $output = $this->manager->createData($resource)->toArray();

            return response()->json($output, 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>'todo not found!'], 404);
        }
    }

    /**
     * Finish one todo
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function finishToDo(Request $request, $id)
    {
        $this->validate($request, ['status'=>'in:DONE,PENDING']);

        try {
            $toDo = ToDo::findOrFail($id);
            $toDo->update($request->all());

            $resource = new Item($toDo, new ToDoTransformer());
            $output = $this->manager->createData($resource)->toArray();

            return response()->json($output, 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>'todo not found!'], 404);
        }
    }

    /**
     * Open one todo
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function openToDo(Request $request, $id)
    {
        $this->validate($request, ['status'=>'in:DONE,PENDING']);

        try {
            $toDo = ToDo::findOrFail($id);
            $toDo->update($request->all());

            $resource = new Item($toDo, new ToDoTransformer());
            $output = $this->manager->createData($resource)->toArray();

            return response()->json($output, 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>'todo not found!'], 404);
        }
    }

    /**
     * Delete one todo
     *
     * @param $id
     * @return JsonResponse
     */
    public function delete($id)
    {
        try {
            ToDo::findOrFail($id);
            ToDo::destroy($id);

            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['message'=>'todo not found!'], 404);
        }
    }
}
