<?php

namespace App\Http\Controllers\Countries;

use App\Http\Controllers\Controller;
use App\Http\Resources\Countries\CountryCollection;
use App\Http\Resources\Countries\CountryResource;
use App\Http\Response;
use App\Services\Countries\CountryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    private CountryService $_service;
    public function __construct(CountryService $service)
    {
        $this->_service = $service;
    }

    public function all(Request $request) : CountryCollection
    {
        $pages = $request->get("pages", 10);
        $language = $request->get("language", app()->getLocale());
        $model = $this->_service->model();
        return new CountryCollection($model::paginate($pages), $language);
    }

    public function create(Request $request) : CountryResource
    {
        $data = $request->all();
        $country = $this->_service->create($data);
        return new CountryResource($country);
    }


    public function get(Request $request, $id) : CountryResource
    {
        $language = $request->get("language", app()->getLocale());
        $country = $this->_service->find($id);
        return new CountryResource($country, $language);
    }

    public function update(Request $request, $id) : CountryResource
    {
        $data = $request->all();
        $country = $this->_service->update($id, $data);
        return new CountryResource($country);
    }


    public function delete($id) : JsonResponse
    {
        $this->_service->delete($id);
        return Response::ok();
    }
}
