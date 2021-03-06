<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use League\Fractal\Manager;


class Controller extends BaseController
{
    /**
     * @var Manager
     */
    protected $manager;

    public function __construct()
    {
        $this->manager = new Manager();
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
