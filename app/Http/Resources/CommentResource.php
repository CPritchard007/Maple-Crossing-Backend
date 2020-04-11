<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            "id" => $this->id,
            "profile" => $this->user,
            "comment" => $this->comment,
            "rank" => $this->rank,
            "solved" => $this->solved
        ];
    }
}
