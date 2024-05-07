<?php

namespace App\Http\Controllers;

use App\my_modules\products_module;
use Exception;
use Illuminate\Http\Request;

class EloquentproductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function table(Request $request)
    {
        try {

            $response=(new products_module)->get_product_table($request);

            return ["data"=>$response];
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()
            ], 401);

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $response=(new products_module)->new_product($request);

            return ["data"=>$response];
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()
            ], 401);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try {

            $response=(new products_module)->select_product($request);

            return ["data"=>$response];
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()
            ], 401);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {

            $response=(new products_module)->update_product($request);

            return ["data"=>$response];
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()
            ], 401);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {

            $response=(new products_module)->delete_product($request);

            return ["data"=>$response];
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()
            ], 401);

        }
    }

}
