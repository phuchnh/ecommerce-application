<?php

namespace App\Http\Resources;

use App\Models\Promotion;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use function GuzzleHttp\Psr7\str;

/**
 * @mixin Promotion
 */
class PromotionResource extends JsonResource
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
            'promotion_type' => $this->promotion_type,
            'cover_image' => $this->cover_image,
            'cover_image_url' => Storage::disk('public')->url($this->cover_image),
            'title' => $this->title,
            'content' => $this->when(!$request->routeIs(['index']), function () {
                return $this->content;
            }),
            'from_date' => (string) $this->from_date,
            'to_date' => (string) $this->to_date,
            'published_at' => (string) $this->published_at,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
