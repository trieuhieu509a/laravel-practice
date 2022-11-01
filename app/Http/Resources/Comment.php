<?php

namespace App\Http\Resources;

use App\Http\Resources\CommentUser as CommentUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
//            'user' => new CommentUserResource($this->user)
            'user' => new CommentUserResource($this->whenLoaded('user'))
        ];
    }
}
