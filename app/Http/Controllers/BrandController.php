<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Выборка элементов марок Авто
     * @param Request $request
     * @return array
     */
    public function index(Request $request): array
    {
        $offset = (int) $request->input('offset', 0);
        $resSelect = Brand::offset($offset)->paginate(10);
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
