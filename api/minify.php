<?php

require_once '../lib/JSMinPlus.php';

$jsList = $_REQUEST["files"];
$output_filename = $_REQUEST["filename"];
$script = "";
foreach ($jsList as $file) {
    $filename = basename($file);
//    $script .= "\n/* Start file $filename */\n";
    $script .= JSMinPlus::minify(file_get_contents($file),$filename).";";
//    $script .= "\n/* End file $filename */\n";
}
header("Content-type: text/javascript");
header("Content-Disposition: attachment; filename=\"$output_filename.js\"");
echo $script;
?>
