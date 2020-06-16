<?php

namespace App\Http\Controllers\Api\Company;

use App\Company;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Empresas",
 *     description="Endpoints para el módulo de empresas"
 * )
 */
class CompanyController extends ApiControllerV1
{
    /**
     * Create a new CompanyController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/companies",
     *     summary="Listado de empresas",
     *     tags={"Empresas"},
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el listado de empresas.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Usuario no autorizado.",
     *     ),
     *     security={ {"bearer": {}} },
     * )
     */
    public function index()
    {
        $companies = Company::all();

        return $this->showAll($companies);
    }

    /**
     * @OA\Get(
     *     path="/companies/{id}",
     *     summary="Muestra una empresa",
     *     tags={"Empresas"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id de la empresa",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra una empresa dado un id.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Usuario no autorizado.",
     *     ),
     *     security={ {"bearer": {}} },
     * )
     */
    public function show(Company $company)
    {
        return $this->showOne($company);
    }
}
