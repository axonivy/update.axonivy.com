<?php
namespace axonivy\update\controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class HomePageController
{

    public function __invoke(Request $request, Response $response)
    {
        echo 'update.axonivy.com provides an API to get release information of the awesome <a href="https://developer.axonivy.com"><b>Axon.ivy BPM Suite</b></a>';
        return $response;
    }
}
