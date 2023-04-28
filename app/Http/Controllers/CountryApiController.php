<?php

namespace App\Http\Controllers;

use App\Http\Response;
use App\Modules\Core\Presenters\Presenter;
use App\Modules\Countries\Services\CountryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryApiController extends Controller
{

    private CountryService $_service;
    public function __construct(CountryService $service)
    {
        $this->_service = $service;
    }

    public function all(Request $request) : JsonResponse {
        $pages = $request->get("pages", 10);

        $countries = $this->_service->all()->paginate($pages)->withQueryString();
        $json = Presenter::recordsWithTranslations($countries->toArray());
        return Response::json($json);
    }

    public function list(Request $request) : JsonResponse {
        $pages = $request->get("pages", 10);
        $language = $request->get("language", app()->getLocale());

        $countries = $this->_service->list($language)->paginate($pages)->withQueryString();
        $json = Presenter::recordsWithTranslation($countries->toArray());
        return Response::json($json);
    }

    public function create(Request $request) : JsonResponse{
        $data = $request->all();
        $country = $this->_service->create($data);
        return Response::json(["data" => $country], 201);
    }


    public function get($id) : JsonResponse {
        $country = $this->_service->get($id);
        $json = Presenter::recordWithTranslations($country->toArray());

        return Response::json(["data" => $json]);
    }

    public function update(Request $request, $id) : JsonResponse {
        $data = $request->all();
        $country = $this->_service->update($id, $data);
        return Response::json(["data" => $country]);
    }


    public function delete($id) : JsonResponse
    {
        $this->_service->delete($id);
        return Response::ok();
    }
}
