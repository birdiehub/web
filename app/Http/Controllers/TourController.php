<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\TourService;
use App\Http\Resources\Tours\TourCollection;

class TourController extends Controller
{
    private string $_class;
    private TourService $_service;

    public function __construct(TourService $service)
    {
        $this->_service = $service;
        $this->_class = $this->_service->model()::class;
    }

    public function all(Request $request) {
        $tours = $this->_service->model()::all();
        return new TourCollection($tours);
    }

}
