<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->fields === 'fields') {
            return [
                'description' => $this->description,
                'images' => $this->images,
            ];
        } else {
            return [
                'id' => $this->id,
                'description' => $this->description,
                'name' => $this->name,
                'price' => $this->price,
            ];
        }
    }
}
