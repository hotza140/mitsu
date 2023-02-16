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
    protected $prefix = 'http://hot.orangeworkshop.info/mitsu/img/upload/';

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
                    'pictures' => 'required',
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
                $filePicture = $_FILES['pictures']['name'][$key];
                $picture->move(public_path() . '/img/upload', $filePicture);
                $carPicture = new CarPicture();
                $carPicture->car_service_id = $carService->id;
                $carPicture->picture = $filePicture;
                $carPicture->save();
            }
            return response()->json([
                'status' =>  true,
                'message' =>  'Service created successfully',
                'url_picture' => $this->prefix,
                'results' => []
            ], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'results' => [],
                'status' =>  false,
                'message' =>  $e->getMessage(),
                'url_picture' => $this->prefix,
            ], 400);
        }
    }

    public function getCarList(Request $req)
    {
        try {
            $rule =
                [
                    'machanic_id' => 'required|integer',
                ];
            $validator = Validator::make($req->all(), $rule);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $carList = CarService::with(['carPictures' => function ($q) {
                $q->first();
            }])->get();
            return response()->json([
                'status' =>  true,
                'message' =>  'success',
                'url_picture' => $this->prefix,
                'results' => [
                    'car' => $carList,
                ]
            ], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'results' => [],
                'status' =>  false,
                'message' =>  $e->getMessage(),
                'url_picture' => $this->prefix,
            ], 400);
        }
    }

    public function updateCarService(Request $req)
    {
        try {
            $rule =
                [
                    'id' => 'required|integer',
                ];
            $validator = Validator::make($req->all(), $rule);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $carService = CarService::find($req->id);
            if (!$carService) {
                throw new Exception('Car not found');
            }
            $carService->brand = $req->brand;
            $carService->model = $req->model;
            $carService->color = $req->color;
            $carService->number_plate = $req->number_plate;
            $carService->save();

            return response()->json([
                'status' =>  true,
                'message' =>  'Service updated successfully',
                'url_picture' => $this->prefix,
                'results' => []
            ], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'results' => [],
                'status' =>  false,
                'message' =>  $e->getMessage(),
                'url_picture' => $this->prefix,
            ], 400);
        }
    }

    public function addCarPicture(Request $req)
    {
        try {
            $rule =
                [
                    'id' => 'required|integer',
                    'pictures' => 'required',
                ];
            $validator = Validator::make($req->all(), $rule);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            foreach ($req->pictures as $key => $picture) {
                $filePicture = $_FILES['pictures']['name'][$key];
                $picture->move(public_path() . '/img/upload', $filePicture);
                $carPicture = new CarPicture();
                $carPicture->car_service_id = $req->id;
                $carPicture->picture = $filePicture;
                $carPicture->save();
            }
            return response()->json([
                'status' =>  true,
                'message' =>  'Picture created successfully',
                'url_picture' => $this->prefix,
                'results' => []
            ], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'results' => [],
                'status' =>  false,
                'message' =>  $e->getMessage(),
                'url_picture' => $this->prefix,
            ], 400);
        }
    }

    public function removeCarPicture(Request $req)
    {
        try {
            $rule =
                [
                    'id' => 'required|integer',
                ];
            $validator = Validator::make($req->all(), $rule);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $carPicture = CarPicture::find($req->id);
            $carPicture->delete();
            return response()->json([
                'status' =>  true,
                'message' =>  'Picture delecte successfully',
                'url_picture' => $this->prefix,
                'results' => []
            ], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'results' => [],
                'status' =>  false,
                'message' =>  $e->getMessage(),
                'url_picture' => $this->prefix,
            ], 400);
        }
    }

    public function getCarDetail(Request $req)
    {
        try {
            $rule =
                [
                    'id' => 'required|integer',
                ];
            $validator = Validator::make($req->all(), $rule);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $carDetail = CarService::find($req->id);
            if (!$carDetail) {
                throw new Exception('Car not found');
            }
            return response()->json([
                'status' =>  true,
                'message' =>  'success',
                'url_picture' => $this->prefix,
                'results' => [
                    'car' => $carDetail,
                ]
            ], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'results' => [],
                'status' =>  false,
                'message' =>  $e->getMessage(),
                'url_picture' => $this->prefix,
            ], 400);
        }
    }

    public function getCarPictureDetail(Request $req)
    {
        try {
            $rule =
                [
                    'id' => 'required|integer',
                ];
            $validator = Validator::make($req->all(), $rule);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $carPictureDetail = CarPicture::whereCarServiceId($req->id)->get();
            return response()->json([
                'status' =>  true,
                'message' =>  'success',
                'url_picture' => $this->prefix,
                'results' => [
                    'car' => $carPictureDetail,
                ]
            ], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'results' => [],
                'status' =>  false,
                'message' =>  $e->getMessage(),
                'url_picture' => $this->prefix,
            ], 400);
        }
    }

    public function removeCarService(Request $req)
    {
        try {
            $rule =
                [
                    'id' => 'required|integer',
                ];
            $validator = Validator::make($req->all(), $rule);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $carService = CarService::find($req->id);
            if (!$carService) {
                throw new Exception('Car not found');
            }
            $carPicture = CarPicture::whereCarServiceId($req->id)->get();
            if ($carPicture) {
                foreach ($carPicture as $key => $value) {
                    $value->delete();
                }
            }
            $carService->delete();
            return response()->json([
                'status' =>  true,
                'message' =>  'Car deleted successfully',
                'url_picture' => $this->prefix,
                'results' => []
            ], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'results' => [],
                'status' =>  false,
                'message' =>  $e->getMessage(),
                'url_picture' => $this->prefix,
            ], 400);
        }
    }
}
