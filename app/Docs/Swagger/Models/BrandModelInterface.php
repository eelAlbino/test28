<?php
namespace App\Docs\Swagger\Models;

/**
 * @OA\Schema(
 *      schema="Brand",
 *      title="Марка автомобиля",
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
 * )
 */

interface BrandModelInterface
{
    
}