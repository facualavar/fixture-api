<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

use function PHPUnit\Framework\matches;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::with('teams')->get();
        return response()->json($groups, 200);
    }

    public function show(int $id)
    {
        $group = Group::with('teams')->find($id);
        return response()->json($group, 200);
    }
}
