<?php
namespace App\Docs\Swagger\Controllers;

use Illuminate\Http\Request;

interface CarControllerInterface
{

    /**
     * @OA\Get(
     *      path="/api/cars",
     *      operationId="getCars",
     *      tags={"Автомобили пользователя"},
     *      summary="Получение списка авто для пользователя",
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
	 *                          ref="#/components/schemas/Car"
	 *                      )
	 *                  ),
     *              )
     *          )
     *      ),
     *      security={
     *          {"bearer_token": {}}
     *      }
     * )
     */
    public function index(Request $request): array;

    /**
     * @OA\Post(
     *      path="/api/cars",
     *      operationId="storeCar",
     *      tags={"Автомобили пользователя"},
     *      summary="Создает автомобиль",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Car"),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Элемент успешно создан",
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
	 *                      property="number",
	 * 	                    ref="#/components/schemas/Car"
	 * 	                ),
     *              )
     *          ),
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *      ),
     *      security={
     *          {"bearer_token": {}}
     *      }
     * )
     */
    public function store(Request $request);
    
    /**
     * @OA\Get(
     *      path="/api/cars/{id}",
     *      operationId="getCarById",
     *      tags={"Автомобили пользователя"},
     *      summary="Получение элемента авто по ID",
     *      @OA\Parameter(
     *          name="id",
     *          required=true,
     *          description="ID элемента",
     *          in="path",
     *          @OA\Schema(type="integer"),
     *      ),
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
	 *                      property="number",
	 * 	                    ref="#/components/schemas/Car"
	 * 	                ),
     *              )
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Элемент не был найден",
     *      ),
     *      security={
     *          {"bearer_token": {}}
     *      }
     * )
     */
    public function show(int $id);

    /**
     * @OA\Put(
     *      path="/api/cars/{id}",
     *      operationId="updateCar",
     *      tags={"Автомобили пользователя"},
     *      summary="Обновление автомобиля",
     *      @OA\Parameter(
     *          name="id",
     *          description="ID обновляемого элемента",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer"),
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Car"),
     *      ),
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
	 *                      property="number",
	 * 	                    ref="#/components/schemas/Car"
	 * 	                ),
     *              )
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Элемент не был найден",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *      ),
     *      security={
     *          {"bearer_token": {}}
     *      }
     * )
     */
    public function update(Request $request, int $id);

    /**
     * @OA\Delete(
     *      path="/api/cars/{id}",
     *      operationId="deleteCar",
     *      tags={"Автомобили пользователя"},
     *      summary="Удаление автомобиля",
     *      @OA\Parameter(
     *          name="id",
     *          description="ID удаляемого элемента",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer"),
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Удаление прошло успешно"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Элемент не был найден",
     *      ),
     *      security={
     *          {"bearer_token": {}}
     *      }
     * )
     */
    public function destroy(int $id);
}
