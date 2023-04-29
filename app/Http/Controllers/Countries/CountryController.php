<?php

namespace App\Http\Controllers\Countries;

use App\Http\Controllers\Controller;
use App\Http\Presenters\TranslationPresenter;
use App\Http\Response;
use App\Services\Countries\CountryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    use TranslationPresenter;

    private CountryService $_service;
    public function __construct(CountryService $service)
    {
        $this->_service = $service;
    }

    public function all(Request $request) : JsonResponse {
        $pages = $request->get("pages", 10);

        $countries = $this->_service->all()->paginate($pages)->withQueryString();
        $json = $this->recordsWithTranslations($countries->toArray());
        return Response::json($json);
    }

    public function list(Request $request) : JsonResponse {
        $pages = $request->get("pages", 10);
        $language = $request->get("language", app()->getLocale());

        $countries = $this->_service->list($language)->paginate($pages)->withQueryString();
        $json = $this->recordsWithTranslation($countries->toArray());
        return Response::json($json);
    }

    public function create(Request $request) : JsonResponse{
        $data = $request->all();
        $country = $this->_service->create($data);
        return Response::json(["data" => $country], 201);
    }


    public function get($id) : JsonResponse {
        $country = $this->_service->get($id);
        $json = $this->recordWithTranslations($country->toArray());

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
