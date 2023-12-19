<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Docs\Swagger\Controllers\CarControllerInterface;
use App\Models\Car;

class CarController extends Controller implements CarControllerInterface
{
    /**
     * Выборка элементов авто
     * @param Request $request
     * @return array
     */
    public function index(Request $request): array
    {
        $offset = (int) $request->input('offset', 0);
        $user = auth()->user();
        $resSelect = Car::offset($offset)->where('user_id', $user->id)->with(['model', 'color'])->paginate(10);
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
        $user = auth()->user();
        $car = Car::where('user_id', $user->id)->with(['model', 'color'])->find($id);
        return response()->json([
            'success' => !!$car,
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
        $user = auth()->user();
        $data = $request->all();
        $data['user_id'] = $user->id;
        $car = Car::create($data);
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
        $success = false;
        $user = auth()->user();
        $car = Car::where('user_id', $user->id)->find($id);
        if ($car) {
            $car->update($request->all());
            $success = true;
            $car = Car::where('user_id', $user->id)->with(['model', 'color'])->find($id);
        }
        return response()->json([
            'success' => $success,
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
        $user = auth()->user();
        $car = Car::where('user_id', $user->id)->find($id);
        $car->delete();
        return response()->json(null, 204);
    }
}
