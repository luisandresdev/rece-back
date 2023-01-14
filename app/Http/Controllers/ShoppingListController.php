<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use Illuminate\Http\Response;
use App\Http\Requests\StoreShoppingListRequest;
use App\Http\Requests\UpdateShoppingListRequest;

class ShoppingListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shoppingList = ShoppingList::with(['products' => function ($query) {
            $query->where('completed', 1)->count();
        }])
            ->withCount(['products'])
            ->get();
        return response()->json(['data' => $shoppingList], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreShoppingListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShoppingListRequest $request)
    {
        $data = $request->only(ShoppingList::UPDATE_FIELDS);

        $shoppingList = ShoppingList::create($data);

        return response()->json(['data' => $shoppingList], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingList $shoppingList)
    {
        return response()->json(['data' => $shoppingList], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShoppingListRequest  $request
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShoppingListRequest $request, ShoppingList $shoppingList)
    {
        $data = $request->only(ShoppingList::UPDATE_FIELDS);
        $shoppingList->update($data);
        return response()->json(['data' => $shoppingList], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingList $shoppingList)
    {
        $shoppingList->delete();
        $shoppingList->products()->delete();
        return response()->json(['data' => $shoppingList], Response::HTTP_OK);
    }


    /**
     * Vaciar
     */
    public function empty(ShoppingList $shoppingList)
    {
        $shoppingList->products()->delete();
        return response()->json(['data' => $shoppingList], Response::HTTP_OK);
    }
}