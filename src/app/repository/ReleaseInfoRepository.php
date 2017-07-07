<?php 
namespace axonivy\update\repository;

use axonivy\update\model\ReleaseInfo;
use Exception;

class ReleaseInfoRepository
{
    private $releaseDirectory;
    
    public function __construct($releaseDirectory)
    {
        $this->releaseDirectory = $releaseDirectory;
        if (!file_exists($this->releaseDirectory)) {
            throw new Exception("release directory does not exist: $releaseDirectory");
        }
    }
    
    public function getLatestRelease(): ?ReleaseInfo
    {
        $releases = $this->getAvailableReleases();
        if (empty($releases)) {
            return null;
        }
        return $releases[count($releases) - 1];
    }
    
    public function getLatestServiceRelease($currentRelease): ?ReleaseInfo
    {
        $serviceReleases = [];
        
        foreach ($this->getAvailableReleases() as $release) {            
            if ($release->hasMajorMinorPrefix($currentRelease)) {
                $serviceReleases[] = $release;
            }
        }
        
        if (empty($serviceReleases)) {
            return $this->getLatestRelease();
        }
        return $serviceReleases[count($serviceReleases) - 1];
    }
    
    private function getAvailableReleases()
    {
        $releases = [];
        $directories = array_filter(glob($this->releaseDirectory . DIRECTORY_SEPARATOR . '*'), 'is_dir');
        foreach ($directories as $directory) {
            // skip not ready releases (still uploading)
            $releaseNotReadyFile = $directory . DIRECTORY_SEPARATOR . 'NotReady.txt';
            if (file_exists($releaseNotReadyFile)) {
                continue;
            }
            
            // skip releases without release info (no official/public releases) 
            $releaseInfoFile = $directory . DIRECTORY_SEPARATOR . 'ReleaseInfo.txt';
            if (!file_exists($releaseInfoFile)) {
                continue;
            }
            
            $releases[] = self::parseReleaseInfo($releaseInfoFile);
        }
        $releases = ReleaseInfo::sortReleaseInfosByVersion($releases);
        return $releases;
    }
    
    private static function parseReleaseInfo($releaseInfoFile)
    {
        $lines = file($releaseInfoFile);
        $version = trim($lines[0]);
        $downloadUrl = trim($lines[1]);
        return new ReleaseInfo($version, $downloadUrl);
    }
    
}
