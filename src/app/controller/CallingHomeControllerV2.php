<?php
namespace axonivy\update\controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use axonivy\update\repository\ProductLogRepository;
use axonivy\update\repository\ReleaseInfoRepository;
use axonivy\update\model\ProductLogRecord;


class CallingHomeControllerV2
{
    private ProductLogRepository $productLogRepo;
    private ReleaseInfoRepository $releaseInfoRepo;

    public function __construct(ProductLogRepository $productLogRepo, ReleaseInfoRepository $releaseInfoRepo)
    {
        $this->productLogRepo = $productLogRepo;
        $this->releaseInfoRepo = $releaseInfoRepo;
    }

    public function product(Request $request, Response $response): Response
    {
        $payload = json_decode($request->getBody());
        $name = $payload->IvyProduct->name;
        $version = $payload->IvyProduct->version;

        $record = new ProductLogRecord(time(), $this->ipAddress(), $name, $version, json_encode($payload));
        $this->productLogRepo->write($record);
        
        $info = $this->releaseInfo($version);
        return $this->respond($response, $info);
    }

    private function ipAddress(): string
    {
        return $_SERVER['REMOTE_ADDR'] ?? ''; // or use a middleware to get the ip
    }

    private function releaseInfo($version) 
    {
        $info = $this->releaseInfoRepo->getCurrentReleaseInfo($version);
        $info->url='https://developer.axonivy.com/download/';
        return $info;
    }
    
    private function respond(Response $response, $releaseInfo): Response
    {
        $json = json_encode($releaseInfo);
        $response->getBody()->write($json);
        $response->withAddedHeader('Expires', 0);
        return $response;
    }
}