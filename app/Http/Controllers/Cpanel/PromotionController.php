<?php

namespace App\Http\Controllers\Cpanel;

use App\Http\Requests\PromotionCreatesRequest;
use App\Http\Requests\PromotionUpdatesRequest;
use App\Http\Resources\MediaResource;
use App\Http\Resources\PromotionResource;
use App\Models\Media;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class PromotionController extends CpanelBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->setPageTitle('Promotion');

        $query = QueryBuilder::for(Promotion::class)
            ->allowedFilters(['title'])
            ->simplePaginate(10);

        return Inertia::render('Promotions/Index', [
            'filter' => $request->get('filter', (object) []),
            'sort' => $request->get('sort'),
            'media' => function () use ($query) {
                return PromotionResource::collection($query);
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
        $this->setPageTitle('Promotion - Create');

        return Inertia::render('Promotions/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PromotionCreatesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromotionCreatesRequest $request)
    {
        Promotion::create($request->validated());

        return Redirect::route('cpanel.promotions.index')->with('message', 'Promotion created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PromotionUpdatesRequest  $request
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(PromotionUpdatesRequest $request, Promotion $promotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return Redirect::route('cpanel.promotions.index')->with('message', 'Successfully deletes promotion.');
    }
}
