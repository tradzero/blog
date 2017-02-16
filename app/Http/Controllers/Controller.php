<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function guestLike($type, $behavior, $field, $id)
    {
        if (!Session($field . ':' . $id)) {
            $type->increment($behavior);
            Session([$field . ':' . $id => true]);
            return true;
        }
        return false;
    }
}
