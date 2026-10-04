<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function getAll()
    {
        return Task::where('user_id', auth()->id())
            ->orderBy('done', 'asc')
            ->orderByRaw("
                CASE
                    WHEN priority = 'alta' THEN 1
                    WHEN priority = 'media' THEN 2
                    ELSE 3
                END
            ")
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function create(array $data)
    {
        $data['user_id'] = auth()->id();
        $data['done'] = false;

        return Task::create($data);
    }

    public function update(Task $task, array $data)
    {
        $this->validateOwner($task);

        $task->update($data);

        return $task;
    }

    public function delete(Task $task)
    {
        $this->validateOwner($task);

        return $task->delete();
    }

    public function toggle(Task $task)
    {
        $this->validateOwner($task);

        $task->done = !$task->done;
        $task->save();

        return $task;
    }

    public function validateOwner(Task $task)
    {
        abort_unless(
            $task->user_id === auth()->id(),
            403
        );
    }
}