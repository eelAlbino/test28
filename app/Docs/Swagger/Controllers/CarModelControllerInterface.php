<?php
namespace App\Docs\Swagger\Controllers;

use Illuminate\Http\Request;

interface CarModelControllerInterface
{

    /**
     * @OA\Get(
     *      path="/api/car-model",
     *      operationId="getModels",
     *      tags={"Модели автомобилей"},
     *      summary="Получение списка моделей автомобилей",
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
	 *                          ref="#/components/schemas/CarModel"
	 *                      )
	 *                  ),
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request): array;
}
