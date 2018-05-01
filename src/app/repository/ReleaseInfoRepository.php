<?php 
namespace axonivy\update\repository;

class ReleaseInfoRepository
{
    private $developerAPI;
    
    public function __construct($developerAPI)
    {
        $this->developerAPI = $developerAPI;
    }
    
    public function getCurrentReleaseInfo($currentRelease)
    {
        $url = $this->developerAPI . '/currentRelease?releaseVersion=' . $currentRelease;
        $response = file_get_contents($url);
        return json_decode($response);
    }
    
}
