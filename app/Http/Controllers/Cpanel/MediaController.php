<?php

namespace App\Http\Controllers\Cpanel;

use App\Http\Requests\MediaUploadRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class MediaController extends CpanelBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $this->setPageTitle('Media');
        $query = QueryBuilder::for(Media::class)
            ->allowedFilters(['name'])
            ->simplePaginate(10);

        return Inertia::render('Media', [
            'filter' => $request->get('filter'),
            'sort' => $request->get('sort'),
            'media' => function () use ($query) {
                return MediaResource::collection($query);
            },
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  MediaUploadRequest  $request
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(MediaUploadRequest $request, Media $media)
    {
        $image = $request->file('image');
        $media = new Media();
        $media->name = $image->getClientOriginalName();
        $media->mime_type = $image->getMimeType();
        $media->size = $image->getSize();
        $media->storage_disk = 'public';
        $media->path = optional($request->file('image'))->storePublicly('media', [
            'disk' => $media->storage_disk
        ]);

        try {
            $media->saveOrFail();
        } catch (\Throwable $e) {
            return Redirect::route('cpanel.media.index');
        }

        return Redirect::route('cpanel.media.index')->with('message', 'Successfully upload file.');
    }
}
