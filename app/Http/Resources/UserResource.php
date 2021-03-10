<?php


namespace App\Http\Resources;


class UserResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->filtrateFields([
            'id' => $this->id,
            'login' => $this->login,
            'tfa' => $this->tfa
        ]);
    }

}
