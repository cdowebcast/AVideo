<?php

require_once '../videos/configuration.php';
session_write_close();
require_once $global['systemRootPath'] . 'objects/video.php';
//getTotalVideosInfo($status = "viewable", $showOnlyLoggedUserVideos = false, 
//$ignoreGroup = false, $videosArrayId = array(), $getStatistcs = false) 
$status = $argv[1];
$showOnlyLoggedUserVideos = boolval($argv[2]);
$ignoreGroup = boolval($argv[3]);
$videosArrayId = json_decode($argv[4]);
$getStatistcs = boolval($argv[5]);
$cacheFileName = $argv[6];
$lockFile = $cacheFileName.".lock";
if(file_exists($lockFile)){
    return false;
}
file_put_contents($lockFile, 1);
$total = Video::getTotalVideosInfo($status, $showOnlyLoggedUserVideos, $ignoreGroup, $videosArrayId, $getStatistcs);
file_put_contents($cacheFileName, json_encode($total));
unlink($lockFile);