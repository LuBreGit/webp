<?
session_start();

$dir = "uploads/" . session_id();
@mkdir($dir);

$source      = $_FILES["upfile"]["tmp_name"];
$destination = $dir . "/" . $_FILES["upfile"]["name"];
move_uploaded_file($source, $destination);

$compression = $_SESSION['compressione'];

$file     = $dir . "/" . $_FILES["upfile"]["name"];
$im       = imagecreatefromstring(file_get_contents($file));
imagepalettetotruecolor($im);

$file_webp = str_replace(".jpg",".webp",$file);
$file_webp = str_replace(".png",".webp",$file_webp);

imagewebp($im, $file_webp, $compression);
imagedestroy($im);

$size_before   = round(filesize($file)/1000);
$size_after    = round(filesize($file_webp)/1000);
$percent_after = -1 * round((100 - 100/$size_before * $size_after),1);

echo "<br><b>$size_before</b>KB &rarr; <b>$size_after</b>KB &rarr; <b>$percent_after</b>%";
echo '<br><img style="height: 4rem" src="'.$file_webp.'">';
echo '<hr>';
?>