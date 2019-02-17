<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Operation;
use Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function operation($op)
    {
        $operation = new Operation;
        $operation->operation_DATETIME = Carbon\Carbon::now();
        $operation->operation_USER_ID = auth()->user()->id;
        $operation->operation_NAME = $op;
        $operation->timestamps = false;
        $operation->save();
    }
}
