<?php

namespace App\Http\Resources\Series;

use Illuminate\Http\Resources\Json\JsonResource;

class SeriesShowResource extends JsonResource{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request){

        return [

            "id"                  => $this->id,
            "seasons_qty"         => $this->seasons_qty,
            "episodes_per_season" => $this->episodes_per_season,
            "links"               => $this->links
            
        ];

    }
    
}
