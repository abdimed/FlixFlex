<?php

namespace App\Http\Resources;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Resources\Json\JsonResource;

class TitleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($this->whenLoaded('favorites'));
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'popularity' => $this->popularity,
            'overview' => $this->overview,
            'trailer' => $this->when(
                request()->is('*/trailer'),
                fn () =>  $this->trailer['url']
            )

        ];
    }
}
