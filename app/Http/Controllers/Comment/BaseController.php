<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Service\Comment\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
