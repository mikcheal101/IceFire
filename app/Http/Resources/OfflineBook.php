<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OfflineBook extends JsonResource
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
            'name' => $this['name'],
            'isbn' => $this['isbn'],
            'authors' => $this['authors'],
            'number_of_pages' => $this['numberOfPages'],
            'publisher' => $this['publisher'],
            'country' => $this['country'],
            'release_date' => Carbon::parse($this['released'])->format('Y-m-d'),
        ];
    }
}
