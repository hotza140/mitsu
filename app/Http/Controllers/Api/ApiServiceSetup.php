<?php

namespace App\Http\Controllers\Api;

use App\CertificateServicePicture;
use App\EducationServicePicture;
use Exception;
use App\Models\CarPicture;
use App\Models\CarService;
use Illuminate\Http\Request;
use App\Models\TechnicianService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ToolPicture;
use App\Models\ToolService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ApiServiceSetup extends Controller
{
    protected $prefix = 'http://hot.orangeworkshop.info/mitsu/img/upload/';


    // Car Service Start

    public function addCarService(Request $req)
    {
        try {

            $rule =
                [
                    'machanic_id' => 'required',
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
                $file = $req->file('picture');
                $filePicture = $_FILES['pictures']['name'][$key];
                $filePath = 'file/upload/' . $filePicture;
                Storage::disk('s3')->put($filePath, file_get_contents($file));

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

            $carList = CarService::with('carPictures')->get();
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
                    'pictures' => 'required|array',
                ];
            $validator = Validator::make($req->all(), $rule);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            foreach ($req->pictures as $key => $picture) {
                $file = $req->file('picture');
                $filePicture = $_FILES['pictures']['name'][$key];
                $filePath = 'file/upload/' . $filePicture;
                Storage::disk('s3')->put($filePath, file_get_contents($file));

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

    // Car Service End



    // Technician Service Start

    public function addTechnicianService(Request $req)
    {
        try {
            $rule =
                [
                    'machanic_id' => 'required',
                    'fname' => 'required|string',
                    'lname' => 'required|string',
                    'nick_name' => 'required|string',
                    'phone' => 'required|string',
                    'line' => 'required|string',
                    'picturesEducate' => 'required|array',
                    'picturesCer' => 'required|array',
                ];
            $validator = Validator::make($req->all(), $rule);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $technician = new TechnicianService();
            $technician->machanic_id = $req->machanic_id;
            $technician->fname = $req->fname;
            $technician->lname = $req->lname;
            $technician->nick_name = $req->nick_name;
            $technician->phone = $req->phone;
            $technician->line = $req->line;
            $technician->save();
            foreach ($req->picturesEducate as $key => $picture) {
                $file = $req->file('picture');
                $filePicture = $_FILES['pictures']['name'][$key];
                $filePath = 'file/upload/' . $filePicture;
                Storage::disk('s3')->put($filePath, file_get_contents($file));

                $educate = new EducationServicePicture();
                $educate->technician_id = $technician->id;
                $educate->picture = $filePicture;
                $educate->save();
            }
            foreach ($req->picturesCer as $key => $picture) {
                $filePicture = $_FILES['picturesCer']['name'][$key];
                $picture->move(public_path() . '/img/upload', $filePicture);
                $cer = new CertificateServicePicture();
                $cer->technician_id = $technician->id;
                $cer->picture = $filePicture;
                $cer->save();
            }
            return response()->json([
                'status' =>  true,
                'message' =>  'Technician created successfully',
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

    public function getTechnicianPicture(Request $request)
    {
        try {
            $rule =
                [
                    'id' => 'required',
                ];
            $validator = Validator::make($request->all(), $rule);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $id = $request->id;
            // $technician = TechnicianService::find($id);
            // if (!$technician) {
            //     throw new Exception('Technician not found');
            // }
            $educate = EducationServicePicture::whereTechnicianId($id)->get();
            $cer = CertificateServicePicture::whereTechnicianId($id)->get();
            return response()->json([
                'status' =>  true,
                'message' =>  'success',
                'url_picture' => $this->prefix,
                'results' => [
                    'educate' => $educate,
                    'cer' => $cer,
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

    public function addTechnicianPicture(Request $req)
    {
        try {
            $rule =
                [
                    'id' => 'required',
                    'type' => 'required',
                    'pictures' => 'required|array',
                ];
            $validator = Validator::make($req->all(), $rule);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            // $technician = TechnicianService::find($req->id);
            // if (!$technician) {
            //     throw new Exception('Technician not found');
            // }
            if ($req->type == 'educate') {
                foreach ($req->pictures as $key => $picture) {
                     $file = $req->file('picture');
                $filePicture = $_FILES['pictures']['name'][$key];
                $filePath = 'file/upload/' . $filePicture;
                Storage::disk('s3')->put($filePath, file_get_contents($file));

                    $educate = new EducationServicePicture();
                    $educate->technician_id = $req->id;
                    $educate->picture = $filePicture;
                    $educate->save();
                }
            } else {
                foreach ($req->pictures as $key => $picture) {
                   $file = $req->file('picture');
                $filePicture = $_FILES['pictures']['name'][$key];
                $filePath = 'file/upload/' . $filePicture;
                Storage::disk('s3')->put($filePath, file_get_contents($file));
                
                    $cer = new CertificateServicePicture();
                    $cer->technician_id = $req->id;
                    $cer->picture = $filePicture;
                    $cer->save();
                }
            }
            return response()->json([
                'status' =>  true,
                'message' =>  'Picture added successfully',
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

    public function removeTechnicianPicture(Request $req)
    {
        try {
            $rule =
                [
                    'type' => 'required|string',
                    'picture_id' => 'required',
                ];
            $validator = Validator::make($req->all(), $rule);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            if ($req->type == 'educate') {
                $educate = EducationServicePicture::find($req->picture_id);
                if (!$educate) {
                    throw new Exception('Picture not found');
                }
                $educate->delete();
            } else {
                $cer = CertificateServicePicture::find($req->picture_id);
                if (!$cer) {
                    throw new Exception('Picture not found');
                }
                $cer->delete();
            }
            return response()->json([
                'status' =>  true,
                'message' =>  'Picture removed successfully',
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

    public function updateTechnicianService(Request $req)
    {
        try {
            $rule =
                [
                    'id' => 'required|integer',
                    'fname' => 'required|string',
                    'lname' => 'required|string',
                    'nick_name' => 'required|string',
                    'phone' => 'required|string',
                    'line' => 'required|string',
                ];
            $validator = Validator::make($req->all(), $rule);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $technician = TechnicianService::find($req->id);
            if (!$technician) {
                throw new Exception('Technician not found');
            }
            $technician->fname = $req->fname;
            $technician->lname = $req->lname;
            $technician->nick_name = $req->nick_name;
            $technician->phone = $req->phone;
            $technician->line = $req->line;
            $technician->save();

            return response()->json([
                'status' =>  true,
                'message' =>  'Technician updated successfully',
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

    public function getTechnicianService(Request $req)
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

            $technicians = TechnicianService::whereMachanicId($req->machanic_id)->get();
            return response()->json([
                'status' =>  true,
                'message' =>  'success',
                'url_picture' => $this->prefix,
                'results' => [
                    'technician' => $technicians,
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

    public function removeTechnicianService(Request $req)
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

            $technician = TechnicianService::find($req->id);
            if (!$technician) {
                throw new Exception('Technician not found');
            }
            $educate = EducationServicePicture::whereTechnicianServiceId($req->id)->get();
            foreach ($educate as $key => $value) {
                $value->delete();
            }
            $cer = CertificateServicePicture::whereTechnicianServiceId($req->id)->get();
            foreach ($cer as $key => $value) {
                $value->delete();
            }
            $technician->delete();
            return response()->json([
                'status' =>  true,
                'message' =>  'Technician deleted successfully',
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

    // Technician Service End


    // Tool Service Start

    public function addToolService(Request $req)
    {
        try {
            $rule =
                [
                    'machanic_id' => 'required',
                    'tool' => 'required|string',
                    'pictures' => 'required|array',

                ];
            $validator = Validator::make($req->all(), $rule);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $tool = new ToolService();
            $tool->machanic_id = $req->machanic_id;
            $tool->tool = $req->tool;
            $tool->save();

            foreach ($req->pictures as $key => $picture) {
                $file = $req->file('picture');
                $filePicture = $_FILES['pictures']['name'][$key];
                $filePath = 'file/upload/' . $filePicture;
                Storage::disk('s3')->put($filePath, file_get_contents($file));

                $toolPicture = new ToolPicture();
                $toolPicture->tool_service_id = $tool->id;
                $toolPicture->picture = $filePicture;
                $toolPicture->save();
            }

            return response()->json([
                'status' =>  true,
                'message' =>  'Tool created successfully',
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

    public function updateToolService(Request $req)
    {
        try {
            $rule =
                [
                    'id' => 'required|integer',
                    'tool' => 'required|string',

                ];
            $validator = Validator::make($req->all(), $rule);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $tool = ToolService::find($req->id);
            if (!$tool) {
                throw new Exception('Tool not found');
            }
            $tool->tool = $req->tool;
            $tool->save();


            return response()->json([
                'status' =>  true,
                'message' =>  'Tool updated successfully',
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

    public function getToolService(Request $req)
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

            $tools = ToolService::with('toolPictures')->whereMachanicId($req->machanic_id)->get();
            return response()->json([
                'status' =>  true,
                'message' =>  'success',
                'url_picture' => $this->prefix,
                'results' => [
                    'tool' => $tools,
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


    public function removeToolService(Request $req)
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

            $tool = ToolService::find($req->id);
            if (!$tool) {
                throw new Exception('Tool not found');
            }

            $pictures = ToolPicture::whereToolServiceId($tool->id)->get();
            foreach ($pictures as $key => $picture) {
                $picture->delete();
            }
            $tool->delete();


            return response()->json([
                'status' =>  true,
                'message' =>  'Tool deleted successfully',
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

    public function addToolPicture(Request $req)
    {
        try {
            $rule =
                [
                    'tool_service_id' => 'required',
                    'pictures' => 'required|array',
                ];
            $validator = Validator::make($req->all(), $rule);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            foreach ($req->pictures as $key => $picture) {
                $file = $req->file('picture');
                $filePicture = $_FILES['pictures']['name'][$key];
                $filePath = 'file/upload/' . $filePicture;
                Storage::disk('s3')->put($filePath, file_get_contents($file));
                
                $toolPicture = new ToolPicture();
                $toolPicture->tool_service_id = $req->tool_service_id;
                $toolPicture->picture = $filePicture;
                $toolPicture->save();
            }

            return response()->json([
                'status' =>  true,
                'message' =>  'Tool picture added successfully',
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

    public function removeToolPicture(Request $req)
    {
        try {
            $rule =
                [
                    'id' => 'required',
                ];
            $validator = Validator::make($req->all(), $rule);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $toolPicture = ToolPicture::find($req->id);
            if (!$toolPicture) {
                throw new Exception('Tool picture not found');
            }
            $toolPicture->delete();

            return response()->json([
                'status' =>  true,
                'message' =>  'Tool picture deleted successfully',
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

    public function getToolPicture(Request $req)
    {
        try {
            $rule =
                [
                    'tool_service_id' => 'required',
                ];
            $validator = Validator::make($req->all(), $rule);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $toolPicture = ToolPicture::whereToolServiceId($req->tool_service_id)->get();

            return response()->json([
                'status' =>  true,
                'message' =>  'success',
                'url_picture' => $this->prefix,
                'results' => [
                    'tool_picture' => $toolPicture,
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

    // Tool Service End
}
