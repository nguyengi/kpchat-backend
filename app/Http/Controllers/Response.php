<?php

namespace App\Http\Controllers;

class Response
{
    public static function ok()
    {
        return response('', 200);
    }

    public static function badRequest()
    {
        return response('Bad Request', 400);
    }

    public static function unauthorized()
    {
        return response('Unauthorized', 401);
    }

    public static function forbidden()
    {
        return response('Forbidden', 403);
    }

    public static function notFound()
    {
        return response('Not Found', 404);
    }
}