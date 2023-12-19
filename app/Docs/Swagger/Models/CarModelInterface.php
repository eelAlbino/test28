<?php
namespace App\Docs\Swagger\Models;

/**
 * @OA\Schema(
 *      schema="Car",
 *      title="Автомобиль",
 *      @OA\Property(
 *          property="id",
 *          type="integer",
 *          format="int64",
 *          description="ID",
 *      ),
 *      @OA\Property(
 *          property="model_id",
 *          type="integer",
 *          description="ID модели",
 *      ),
 *      @OA\Property(
 *          property="model",
 *          ref="#/components/schemas/CarModel"
 * 	    ),
 *      @OA\Property(
 *          property="year_production",
 *          type="integer",
 *          format="int32",
 *          description="Год производства",
 *      ),
 *      @OA\Property(
 *          property="mileage",
 *          type="integer",
 *          format="int32",
 *          description="Пробег, в км",
 *      ),
 *      @OA\Property(
 *          property="color_id",
 *          type="integer",
 *          description="ID цвета",
 *      ),
 *      @OA\Property(
 *          property="color",
 *          ref="#/components/schemas/Color"
 * 	    ),
 *      @OA\Property(
 *          property="user_id",
 *          type="integer",
 *          description="ID пользователя",
 *      ),
 * )
 */

interface CarModelInterface
{
    
}