<?php

namespace App\my_modules;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class products_with_raw_sql
{


    function new_product($request)
    {
        try {
            DB::beginTransaction();
            DB::insert("INSERT INTO `products` (`name`, `price`) VALUES(?,?)",
                [$request->name,$request->price]);
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
            DB::update("UPDATE `products` SET `name` = ?, `price` = ? WHERE `product_id` =?",
                [$request->name,$request->price,$request->id]);
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
            DB::delete("DELETE FROM `products` where `product_id`=? ",[$request->id]);
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
            $product = DB::select("select `name`, `product_id`, `price` from `products`
                             where `product_id`=? ",[$request->id]);

            return $product[0];
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    #this one is fine like this..
    #other methods are exclusive
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
