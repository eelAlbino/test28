<?php
namespace App\Docs\Swagger\Models;

/**
 * @OA\Schema(
 *      schema="CarModel",
 *      title="Модель автомобиля",
 *      @OA\Property(
 *          property="id",
 *          type="integer",
 *          format="int64",
 *          description="ID",
 *      ),
 *      @OA\Property(
 *          property="name",
 *          type="string",
 *          description="Название",
 *      ),
 *      @OA\Property(
 *          property="brand_id",
 *          type="integer",
 *          description="ID бренда",
 *      ),
 *      @OA\Property(
 *          property="brand",
 *          ref="#/components/schemas/Brand"
 * 	    ),
 * )
 */

interface CarModelModelInterface
{
    
}