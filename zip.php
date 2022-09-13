<?
session_start();    

$dir = "uploads/" . session_id();

$zipfile      = $dir . "/webp.zip";
$files_to_zip = $dir . "/*.webp";

$zip = new ZipArchive();
$zip->open($zipfile, ZipArchive::CREATE);
foreach (glob($files_to_zip) as $file) {
    $download_file = file_get_contents($file);
    $zip->addFromString(basename($file),$download_file);
}
$zip->close();
header('Content-Type: application/zip');
header('Content-Length: ' . filesize($zipfile));
header('Content-Disposition: attachment; filename='.session_id().'.zip');
readfile($zipfile);
unlink($zipfile); 

foreach (glob("$dir/*") as $file) {
    unlink($file);
}
rmdir($dir);
?>