<?php

namespace App\Http\Controllers;

use App\Modules\Users\Services\UserService;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    private $_service;
    public function __construct(UserService $service)
    {
        $this->_service = $service;
    }

    public function all(Request $request){

        $pages = $request->get("pages", 10);

        return $this->_service->all($pages);
    }

}
