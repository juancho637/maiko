<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
    /**
     * Generalización de las respuestas JSON exitosas.
     */
    private function jsonResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json($data, $code);
    }

    /**
     * Generalización de las respuestas JSON para los errores.
     */
    protected function errorResponse($message, $code)
    {
        return $this->jsonResponse([
            'error' => $message,
            'code' => $code
        ], $code);
    }

    /**
     * generalización de los mensajes de respuesta
     */
    protected function successMessage($message, $code = 200)
    {
        return $this->jsonResponse([
            'success' => $message,
            'code' => $code
        ], $code);
    }
}
