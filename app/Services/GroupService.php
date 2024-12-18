<?php

namespace App\Services;

use App\Models\Faculty;
use App\Models\Group;

class GroupService
{
    public function create(array $data)
    {
        return Group::create($data);
    }

    public function update(Group $group, array $data)
    {
        $group->update($data);

        return $group;
    }

    public function delete(Group $group)
    {
        $group->delete();
    }
}
