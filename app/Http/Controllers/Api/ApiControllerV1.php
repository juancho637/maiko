<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;

class ApiControllerV1 extends Controller
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
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST
     * )
     */
    public function __construct()
    {
        //
    }
}
