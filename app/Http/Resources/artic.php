<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class artic extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);

       return [
           'id' => $this->id,
           'user_id' => $this->user_id,
           'title' => $this->title,
           'due_date' => $this->due_date,
           'due_time' => $this->due_time,
           'completed' => $this->completed
       ];
    }

    function with($request){
        return[
            'version'=> '0.0.5',
            'author'=> url('otech.com.ng')
        ];
    }
}
