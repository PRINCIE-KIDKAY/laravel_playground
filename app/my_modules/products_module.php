<?php

namespace App\my_modules;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class products_module
{
    #using functions to insert data to dbd

    function new_product($request)
    {
        try {
            DB::beginTransaction();
            DB::table('products')->insert(
                ['name' => $request->name, 'price' => $request->price]
            );
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    function update_product($request)
    {
        try {
            DB::beginTransaction();
            DB::table('products')->where('id', '=', $request->id)->update(
                ['name' => $request->name, 'price' => $request->price]
            );
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    function delete_product($request)
    {
        try {
            DB::beginTransaction();
            DB::table('products')->where('id', '=', $request->id)->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    function select_product($request)
    {
        try {
            DB::beginTransaction();
            $product = DB::table('products')
                ->where('id', '=', $request->id)
                ->select('name', 'id', 'price')
                ->first(); // Assuming you want only the first matching product

            return $product;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    function get_product_table($request)
    {
        try {
            $limit = $request->limit ?? 10; // Set default limit if not provided
            $page = $request->page;

            return DB::table('products')
//                ->where('id', '=', $request->id)
                ->select('name', 'product_id', 'price')
                ->paginate(
                    $limit,
                    ['name,price,product_id'],
                    '',
                    $page);

        } catch (QueryException $e) { // Catch specific pagination errors
            throw new Exception("Pagination failed: " . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }




}
