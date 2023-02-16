<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\CarPicture;
use App\Models\CarService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiServiceSetup extends Controller
{
    public function addCarService(Request $req)
    {
        try {

            $rule =
                [
                    'machanic_id' => 'required|integer',
                    'brand' => 'required|string',
                    'model' => 'required|string',
                    'color' => 'required|string',
                    'number_plate' => 'required|string',
                    'pictures' => 'required|array',
                ];
            $validator = Validator::make($req->all(), $rule);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $carService = new CarService();
            $carService->machanic_id = $req->machanic_id;
            $carService->brand = $req->brand;
            $carService->model = $req->model;
            $carService->color = $req->color;
            $carService->number_plate = $req->number_plate;
            $carService->save();

            foreach ($req->pictures as $key => $picture) {
                $filePicture = $_FILES['pictures'][$key]['name'];
                $picture->move(public_path() . '/img/upload', $filePicture);
                $carPicture = new CarPicture();
                $carPicture->car_service_id = $carService->id;
                $carPicture->picture = $filePicture;
                $carPicture->save();
            }
            return response()->json(['success' => 'Service created successfully'], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
