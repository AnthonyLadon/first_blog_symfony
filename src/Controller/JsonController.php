<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class JsonController
{
    /**
     * @Route("/json/hello")
     */
    public function json_hello(): Response
    {
        $response = new Response();
        $response->setContent(json_encode([
            'username' => 'jane',
        ]));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/json/number")
     */
    public function json_number(): JsonResponse
    {
        $response = new JsonResponse(['data' => 123]);
        return $response;
    }
}
