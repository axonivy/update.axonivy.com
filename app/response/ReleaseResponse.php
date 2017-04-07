<?php
namespace response;

use config\Config;

class ReleaseResponse {
	
	private $currentRelease;
	private $releaseDirectory;
	
	public function __construct($currentRelease) {
		$this->currentRelease = $currentRelease;
		$this->releaseDirectory = Config::RELEASE_DIRECTORY;
		
		if (!file_exists($this->releaseDirectory)) {
			throw new Exception('release directory does not exist ' . $this->releaseDirectory);
		}
	}
	
	public function render() {
		header('Expires: 0');
		echo "\n";
		echo "\n";
		echo 'LatestRelease: ' . $this->getLatestRelease()->getVersion();
		echo "\n";
		echo 'LatestReleaseUrl: ' . $this->getLatestRelease()->getDownloadUrl();
		echo "\n";
		echo 'LatestServiceReleaseForCurrentRelease: ' . $this->getLatestServiceRelease()->getVersion();
		echo "\n";
		echo 'LatestServiceReleaseForCurrentReleaseUrl: ' . $this->getLatestServiceRelease()->getDownloadUrl();
	}
	
	private function getLatestRelease() {
		$releases = $this->getAvailableReleases();
		if (empty($releases)) {
			throw new Exception('no available release');
		}
		return $releases[count($releases) - 1];
	}
	
	private function getLatestServiceRelease() {	
		$serviceReleases = [];
		
		$majorMinorPrefix = self::getMajorMinorPrefixForCurrentRelease();
		foreach ($this->getAvailableReleases() as $release) {
			if (substr($release->getVersion(), 0, strlen($majorMinorPrefix)) === $majorMinorPrefix) {
				$serviceReleases[] = $release;
			}
		}
		
		if (empty($serviceReleases)) {
			return $this->getLatestRelease();
		}
		return $serviceReleases[count($serviceReleases) - 1];
	}
	
	private function getMajorMinorPrefixForCurrentRelease() {
		$versionArray = explode('.', $this->currentRelease);
		return $versionArray[0] . '.' . $versionArray[1];
	}
	
	private function getAvailableReleases() {
		$releases = [];
		
		$directories = array_filter(glob($this->releaseDirectory . DIRECTORY_SEPARATOR  . '*'), 'is_dir');
		foreach ($directories as $directory) {
			// Not ready - still uploading
			$releaseNotReadyFile = $directory . DIRECTORY_SEPARATOR . 'NotReady.txt';
			if (file_exists($releaseNotReadyFile)) {
				continue;
			}
			
			// Release info
			$releaseInfoFile = $directory . DIRECTORY_SEPARATOR . 'ReleaseInfo.txt';
			if (!file_exists($releaseInfoFile)) {
				continue;
			}
			$releases[] = self::parseReleaseInfo($releaseInfoFile);
		}
		
		$releases = self::sortReleases($releases);
		return $releases;
	}
		
	private static function sortReleases($releases) {
		usort($releases, 'self::compareRelease');
		return $releases;
	}
	
	private static function compareRelease(Release $r1, Release $r2) {
		return version_compare($r1->getVersion(), $r2->getVersion());
	}
	
	private static function parseReleaseInfo($releaseInfoFile) {
		$lines = file($releaseInfoFile);
		$version = $lines[0];
		$downloadUrl = $lines[1];
		return new Release($version, $downloadUrl);
	}
	
}

class Release {
	private $version;
	private $downloadUrl;
	public function __construct($version, $downloadUrl) {
		$this->version = $version;
		$this->downloadUrl = $downloadUrl;
	}
	public function getVersion() {return $this->version;}
	public function getDownloadUrl() {return $this->downloadUrl;}
}