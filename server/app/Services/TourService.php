<?php

namespace App\Services;

use App\Models\Tour;
use App\Validators\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TourService extends Service
{

    public function __construct(Tour $model)
    {
        parent::__construct($model);
    }

}

