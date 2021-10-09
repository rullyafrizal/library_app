<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'pages' => $this->pages,
            'cover_path' => $this->cover,
            'release_date' => $this->release_date,
            'author' => $this->whenLoaded('author'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
