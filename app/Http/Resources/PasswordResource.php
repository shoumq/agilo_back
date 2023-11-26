<?php

namespace App\Http\Resources;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PasswordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user_name' => User::where('id', $this->user_id)->first()->name,
            'group_id' => $this->group_id,
            'group_title' => Group::where('id', $this->group_id)->first()->title,
        ];
    }
}
