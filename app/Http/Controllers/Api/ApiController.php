<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    use ApiResponser;

    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Laravel Maiko API Documentation",
     *      @OA\Contact(
     *          email="juancho637@gmail.com"
     *      ),
     * )
     */
    public function __construct()
    {
        //
    }
}
