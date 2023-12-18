<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Выборка элементов авто
     * @param Request $request
     * @return array
     */
    public function index(Request $request): array
    {
        $offset = (int) $request->input('offset', 0);
        $resSelect = auth()->user()->cars::offset($offset)->paginate(10);
        return [
            'success' => true,
            'data' => [
                'items' => $resSelect->items(),
                'total' => $resSelect->total(),
                'offset' => $offset
            ]
        ];
    }

    /**
     * Получение машины для текущего пользователя
     * @param int $id
     */
    public function show(int $id)
    {
        $car = auth()->user()
            ->cars()
            ->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => [
                'elem' => $car
            ]
        ]);
    }

    /**
     * Создание новой машины для текущего пользователя
     * @param Request $request
     */
    public function store(Request $request)
    {
        $car = auth()->user()
            ->cars()
            ->create($request->all());
        return response()->json([
            'success' => true,
            'data' => [
                'elem' => $car
            ]
        ], 201);
    }

    /**
     * Обновление машины для текущего пользователя
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, int $id)
    {
        $car = auth()->user()
            ->cars()
            ->findOrFail($id);
        $car->update($request->all());
        return response()->json([
            'success' => true,
            'data' => [
                'elem' => $car
            ]
        ], 200);
    }

    /**
     * Удаление машины для текущего пользователя
     * @param int $id
     */
    public function destroy(int $id)
    {
        $car = auth()->user()
            ->cars()
            ->findOrFail($id);
        $car->delete();
        return response()->json(null, 204);
    }
}
