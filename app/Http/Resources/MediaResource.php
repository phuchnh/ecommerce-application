<?php

namespace App\Http\Resources;

use App\Models\Media;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin Media
 */
class MediaResource extends JsonResource
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
            'mime_type' => $this->mime_type,
            'name' => $this->name,
            'path' => $this->path,
            'size' => $this->size,
            'url' => Storage::disk($this->storage_disk)->url($this->path),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
