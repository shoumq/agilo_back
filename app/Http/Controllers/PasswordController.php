<?php

namespace App\Http\Controllers;

use App\Http\Resources\PasswordResource;
use App\Models\Group;
use App\Models\Password;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function getPasswords($sector_id): JsonResponse
    {
        $passwords = Password::where('group_id', $sector_id)->get();
        $group = Group::where('id', $sector_id)->first()->title;
        return response()->json([$passwords, ["title" => $group]]);
    }

    public function getPassword($pass_id): JsonResponse
    {
        $passwords = Password::where('id', $pass_id)->get();
        $passwords = PasswordResource::collection($passwords)->resolve()[0];
        return response()->json($passwords);
    }

    public function createPassword(Request $request, $sector_id): JsonResponse
    {
        $request->validate([
            'title' => ['string', 'min:2', 'max:50']
        ]);

        $group = new Password();
        $group->user_id = $request->user_id;
        $group->group_id = $sector_id;
        $group->title = $request->title;
        $group->save();

        return response()->json($group);
    }
}
