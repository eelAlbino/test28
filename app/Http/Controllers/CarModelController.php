<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarModel;
use App\Docs\Swagger\Controllers\CarModelControllerInterface;

class CarModelController extends Controller implements CarModelControllerInterface
{
    /**
     * Выборка элементов моделей Авто
     * @param Request $request
     * @return array
     */
    public function index(Request $request): array
    {
        $offset = (int) $request->input('offset', 0);
        $resSelect = CarModel::with('brand')->offset($offset)->paginate(10);
        return [
            'success' => true,
            'data' => [
                'items' => $resSelect->items(),
                'total' => $resSelect->total(),
                'offset' => $offset
            ]
        ];
    }
}
