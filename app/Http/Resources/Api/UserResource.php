<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'surname' => $this->surname,
            'name' => $this->name,
            'patronymic' => $this->patronymic,
            'sex' => $this->sex,
            'birthday' => $this->birthday,
            'email' => $this->email,
            'role' => $this->role->name,
            ];
    }
}
