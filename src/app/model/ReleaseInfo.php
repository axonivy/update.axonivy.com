<?php
namespace axonivy\update\model;

class ReleaseInfo
{
    
    private $version;
    
    private $downloadUrl;
    
    public function __construct($version, $downloadUrl)
    {
        $this->version = $version;
        $this->downloadUrl = $downloadUrl;
    }
    
    public function getVersion()
    {
        return $this->version;
    }
    
    public function getDownloadUrl()
    {
        return $this->downloadUrl;
    }
    
    public function hasMajorMinorPrefix($version)
    {
        $majorMinorPrefix = self::caluclateMajorMinorPrefix($version);
        return $this->getMajorMinorPrefix() === $majorMinorPrefix;
    }
    
    public function getMajorMinorPrefix()
    {
        return self::caluclateMajorMinorPrefix($this->version);
    }
    
    private static function caluclateMajorMinorPrefix($fullVersion)
    {
        $versionArray = explode('.', $fullVersion);
        $version = '';
        if (isset($versionArray[0]))
        {
            $version .= $versionArray[0];
        }
        
        if (isset($versionArray[1]))
        {
            $version .= '.' . $versionArray[1];
        }
        
        return $version;
    }
    
    public static function sortReleaseInfosByVersion($releases)
    {
        usort($releases, function (ReleaseInfo $r1, ReleaseInfo $r2) {
            return version_compare($r1->getVersion(), $r2->getVersion());
        });
        return $releases;
    }
}