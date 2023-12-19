<?php
namespace App\Docs\Swagger\Controllers;

/**
 * @OA\SecurityScheme(
 *      securityScheme="bearer_token",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 * )
 */
interface AuthControllerInterface
{

    /**
     * @OA\Post(
     *      path="/oauth/token",
     *      operationId="getToken",
     *      tags={"Аутентификация"},
     *      summary="Получение токена аутентификации",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="grant_type",
     *                  type="string",
     *                  example="password",
     *                  description="Тип привелегий. Для получения токена передается password"
     *              ),
     *              @OA\Property(
     *                  property="client_id",
     *                  type="string",
     *                  description="client ID для Passport. Установка passport командой <i>passport:install</i>. Если client ID/secret отсутствуют, для генерации нового можно воспользоваться командой <i>artisan passport:client --password</i>",
     *                  example="pass_client_id",
     *              ),
     *              @OA\Property(
     *                  property="client_secret",
     *                  type="string",
     *                  description="client secret для Passport. Установка passport командой <i>passport:install</i>. Если client ID/secret отсутствуют, для генерации нового можно воспользоваться командой <i>artisan passport:client --password</i>",
     *                  example="pass_client_secret",
     *              ),
     *              @OA\Property(
     *                  property="username",
     *                  type="string",
     *                  description="E-mail пользователя",
     *                  example="test@test.ru",
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  description="Паспорт пользователя",
     *                  example="pass123",
     *              )
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="token_type",
     *                  type="string",
     *                  description="Тип токена",
     *                  example="Bearer"
     *              ),
     *              @OA\Property(
     *                  property="expires_in",
     *                  type="integer",
     *                  description="Продолжительность жизни токена",
     *                  example=3600
     *              ),
     *              @OA\Property(
     *                  property="access_token",
     *                  type="string",
     *                  description="Токен для аутентификации",
     *                  example="your_access_token"
     *              ),
     *              @OA\Property(
     *                  property="refresh_token",
     *                  type="string",
     *                  description="Токен для обновления токена",
     *                  example="your_refresh_token"
     *              ),
     *          ),
     *      ),
     * )
     */
    public function getToken();
}