<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetCoffee;
use App\Http\Requests\GetCoffeeById;
use App\Http\Requests\OrderCoffee;
use App\Models\Coffee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoffeeController extends Controller
{
    public function getCoffee(GetCoffee $request) {
        try {
            $payload = $request->validated();

            $coffee = Coffee::get();

            return response(
                [
                    'data' => $coffee,
                    'statusCode' => 200
                ], 200
            );
        } catch (\Exception $e) {
            return response(
                [
                    'message' => 'Coffee cannot be retrieved, please try again later.',
                    'error' => "$e",
                    'statusCode' => 500,
                ],
                500,
            );
        }
    }

    public function getCoffeeById(GetCoffeeById $request, $id) {
        try {
            $validator = Validator::make(
                array_merge(
                    $request->all(),
                    ['id' => $id]
                ),
                [
                    'id' => 'required|exists:\App\Models\Coffee,id'
                ]
            );

            if ($validator->fails()) {
                return response(
                    [
                        'errors' => $validator->errors()->all(),
                        'message' => 'Invalid data validation.',
                        'statusCode' => 422,
                    ],
                    422
                );
            }

            $payload = $request->validated();

            $coffee = Coffee::where('id', '=', $id)->first();

            return response(
                [
                    'data' => $coffee,
                    'statusCode' => 200
                ], 200
            );
        } catch (\Exception $e) {
            return response(
                [
                    'message' => 'Coffee cannot be retrieved, please try again later.',
                    'error' => "$e",
                    'statusCode' => 500,
                ],
                500,
            );
        }
    }

    public function orderCoffee(OrderCoffee $request, $id) {
        try {
            $validator = Validator::make(
                array_merge(
                    $request->all(),
                    ['id' => $id]
                ),
                [
                    'id' => 'required|exists:\App\Models\Coffee,id'
                ]
            );

            if ($validator->fails()) {
                return response(
                    [
                        'errors' => $validator->errors()->all(),
                        'message' => 'Invalid data validation.',
                        'statusCode' => 422,
                    ],
                    422
                );
            }

            $payload = $request->validated();

            $coffee = Coffee::where('id', '=', $id)->first();
            $coffee['safe_level'] = Coffee::SAFE_COFFEE_LEVEL;
            $coffee['consumable'] = Coffee::SAFE_COFFEE_LEVEL / $payload['quantity'];
            $coffee['left_over'] = (Coffee::SAFE_COFFEE_LEVEL - $payload['quantity']) <= 0 ? 0 : (Coffee::SAFE_COFFEE_LEVEL - $payload['quantity']);

            return response(
                [
                    'data' => $coffee,
                    'statusCode' => 200
                ], 200
            );
        } catch (\Exception $e) {
            return response(
                [
                    'message' => 'Coffee cannot be retrieved, please try again later.',
                    'error' => "$e",
                    'statusCode' => 500,
                ],
                500,
            );
        }
    }
}
