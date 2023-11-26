<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function getGroups($user_id): JsonResponse
    {
        return response()->json(Group::where('user_id', $user_id)->get());
    }

    public function getAllGroups(): JsonResponse
    {
        return response()->json(Group::all());
    }

    public function createGroup(Request $request): JsonResponse
    {
        $request->validate([
            'title' => ['string', 'min:2', 'max:50']
        ]);

        $group = new Group();
        $group->user_id = $request->user_id;
        $group->title = $request->title;
        $group->save();

        return response()->json($group);
    }
}
