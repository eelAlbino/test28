<?php
namespace App\Docs\Swagger\Controllers;

use Illuminate\Http\Request;

interface BrandControllerInterface
{

    /**
     * @OA\Get(
     *      path="/api/brand",
     *      operationId="getBrands",
     *      tags={"Марки автомобилей"},
     *      summary="Получение списка марок автомобилей",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean",
     *                  example="true",
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(
	 *                      property="items",
	 *                      type="array",
     *                      @OA\Items(
	 *                          ref="#/components/schemas/Brand"
	 *                      )
	 *                  ),
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request): array;
}
