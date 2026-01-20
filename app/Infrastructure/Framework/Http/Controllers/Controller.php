<?php

namespace App\Infrastructure\Framework\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    description: "API документация для сервиса товаров",
    title: "Product Service API",
    contact: new OA\Contact(email: "yuriyseraz@gmail.com")
)]
#[OA\Server(
    url: L5_SWAGGER_CONST_HOST,
    description: "API Server"
)]
abstract class Controller
{
    //
}
