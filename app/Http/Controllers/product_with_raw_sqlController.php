<?php

namespace App\Http\Controllers;

use App\my_modules\products_with_raw_sql;
use Exception;
use Illuminate\Http\Request;

class product_with_raw_sqlController extends Controller
{
    public function table(Request $request)
    {
        try {

            $response=(new products_with_raw_sql)->get_product_table($request);

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

            $response=(new products_with_raw_sql)->new_product($request);

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

            $response=(new products_with_raw_sql)->select_product($request);

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

            $response=(new products_with_raw_sql)->update_product($request);

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

            $response=(new products_with_raw_sql)->delete_product($request);

            return ["data"=>$response];
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()
            ], 401);

        }
    }

}
