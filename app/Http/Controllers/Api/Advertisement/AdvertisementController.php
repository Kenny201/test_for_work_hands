<?php

namespace App\Http\Controllers\Api\Advertisement;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdvertisementRequest;
use App\Http\Resources\AdvertisementDetailResource;
use App\Http\Resources\AdvertisementResource;
use App\Http\Resources\AdvertisementsResource;
use App\Http\Responses\ApiResponseClass;
use App\Repositories\AdvertisementRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function __construct(private readonly AdvertisementRepository $advertisementRepositoryInterface) { }
    public function show($advertisementId)
    {
        try {
            $advertisement = $this->advertisementRepositoryInterface->getById($advertisementId);
            return ApiResponseClass::sendResponse(new AdvertisementDetailResource($advertisement), '', 200);
        }
        catch (ModelNotFoundException $ex) {
            return ApiResponseClass::notFound($ex);
        }
        catch (\Exception $ex) {
            return ApiResponseClass::throw($ex, $ex->getMessage());
        }

    }
    public function index(Request $request)
    {
        $details = [
            'sort_field' => $request->sort_field,
            'sort_direction' => $request->sort_direction,
        ];

        $data = $this->advertisementRepositoryInterface->index($details);

        return ApiResponseClass::sendResponse(AdvertisementsResource::collection($data), '', 200);
    }

    public function store(StoreAdvertisementRequest $request)
    {
        $details = [
            'name' => $request->name,
            'description' => $request->description,
            'images' => $request->images,
            'price' => $request->price,
        ];

        try {
            $advertisement = $this->advertisementRepositoryInterface->store($details);

            return ApiResponseClass::sendResponse(new AdvertisementResource($advertisement),
                'Объявление cоздано успешно',
                201);
        } catch (\Exception $ex) {
            return ApiResponseClass::throw($ex, $ex->getMessage());
        }
    }
}
