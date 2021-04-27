<?php

namespace App\Http\Controllers\Cpanel;

use App\Http\Controllers\Cpanel\Filters\FilterPromotionByStatus;
use App\Http\Requests\PromotionCreatesRequest;
use App\Http\Requests\PromotionUpdatesRequest;
use App\Http\Resources\PromotionResource;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PromotionController extends CpanelBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $this->setPageTitle('Promotion');

        $query = QueryBuilder::for(Promotion::class)
            ->allowedFilters([
                AllowedFilter::partial('keyword', 'title'),
                AllowedFilter::exact('type', 'promotion_type')->ignore(null),
                AllowedFilter::custom('active', new FilterPromotionByStatus()),
            ])
            ->defaultSorts(['-updated_at'])
            ->simplePaginate(10);

        return Inertia::render('Promotions/Index', [
            'filter' => $request->get('filter', (object) []),
            'sort' => $request->get('sort'),
            'promotions' => function () use ($query) {
                return PromotionResource::collection($query);
            },
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
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
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(PromotionCreatesRequest $request)
    {
        Promotion::create($request->validatedInputs());

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
     * @return \Inertia\Response
     */
    public function edit(Promotion $promotion)
    {
        $this->setPageTitle('Promotion - Edit');

        return Inertia::render('Promotions/Edit', [
            'promotion' => new PromotionResource($promotion)
        ]);
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
        $promotion->update($request->validatedInputs());
        return Redirect::back()->with('message', 'Promotion updated.');
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
        return Redirect::route('cpanel.promotions.index')->with('message', 'Promotion deleted.');
    }

    /**
     * Publish the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function publish(Promotion $promotion)
    {
        if ($promotion->published_at) {
            $promotion->update(['published_at' => null]);
        } else {
            $promotion->update(['published_at' => $promotion->freshTimestamp()]);
        }

        return Redirect::route('cpanel.promotions.index');
    }
}
