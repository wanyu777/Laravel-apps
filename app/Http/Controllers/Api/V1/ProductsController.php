<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Products;
use App\Http\Requests\V1\StoreProductsRequest;
use App\Http\Requests\V1\UpdateProductsRequest;
use App\Http\Resources\V1\ProductCollection;
use App\Http\Resources\V1\ProductResource;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ProductCollection(Products::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductsRequest $request)
    {
        $imagePath = $request->handleImageUpload();

    $product = Products::create([
        'name'        => $request->name,
        'price'       => $request->price,
        'image'  => $imagePath,
    ]);

    return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductsRequest $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product)
    {
        $prod = Products::findOrFail($product);
        if($prod->image && \Storage::disk('public')->exists(($prod->image))){
            \Storage::disk('public')->delete($prod->image);
        }
        $prod->delete();
    }
}
