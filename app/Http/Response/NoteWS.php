<?php


namespace App\Http\Response;


use App\Models\Note;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteWS extends JsonResource
{
    public function toArray($request)
    {
        /** @var Note $this */
        $programed = [];
        if ($this->programed){
            $programed['programed'] = $this->programed->format('d-m-Y h:i a');
            $programed['programed_time'] = $this->programed->timestamp;
        }
        return array_merge($programed,[
            'title' => $this->title,
            'text' => $this->text,
            'created' =>  $this->created_at->format('d-m-Y')
        ]);
    }

}
