<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NewBook extends JsonResource
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
            'name' => $this->name,
            'isbn' => $this->isbn,
            'authors' => collect($this->authors)->map(function ($author) {
                return $author->name;
            }),
            'number_of_pages' => $this->number_of_pages,
            'publisher' => $this->publisher,
            'country' => $this->country,
            'release_date' => Carbon::parse($this->release_date)->format('Y-m-d'),
        ];
    }
}
