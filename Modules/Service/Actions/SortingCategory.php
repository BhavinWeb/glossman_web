<?php

namespace Modules\Service\Actions;

use Modules\Service\Entities\Service;

class SortingService
{
    public static function sort($request)
    {
        $tasks = Service::all();
        foreach ($tasks as $task) {
            $task->timestamps = false;
            $id = $task->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->update(['order' => $order['position']]);
                }
            }
        }

        return true;
    }
}
