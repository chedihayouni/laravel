<?php


namespace App\Transformers;

use App\Models\ToDo;
use League\Fractal\TransformerAbstract;

class ToDoTransformer extends TransformerAbstract
{
    public function transform(ToDo $toDo)
    {
        return [
            'id'          => $toDo->getId(),
            'title'       => $toDo->getTitle(),
            'description' => $toDo->getDescription(),
            'status'      => $toDo->getStatus(),
            'date'        => $toDo->getDate()
        ];
    }
}
