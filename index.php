<?
session_start();

$_SESSION['compressione'] = 85;

if(isset($_GET['c']))
  $_SESSION['compressione'] = $_GET['c'];

?>

<!DOCTYPE html>
<html>
  <head>
    <title>
      Webpp
    </title>

    <!-- (A) CSS + JS -->
    <script src="dd-upload.js"></script>
  </head>
  <body style="font-family: Tahoma">
    <!-- (B) FILE DROP ZONE -->

    <h3>1. Choose quality</h3>
    <select onchange="document.location.href = '?c=' + this.value" style="padding: 0.5rem; font-size: 1.2rem; font-weight: bold" >
      <option value="<?=$_SESSION['compressione']?>"><?=$_SESSION['compressione']?></option>
      <option value="<?=$_SESSION['compressione']?>"></option>
      <?for($i=100; $i > 0; $i-=5){?>
      <option value="<?=$i?>"><?=$i?></option>
      <?}?>
    </select>
    

    <h3>2. Drop your files</h3>
    <div id="upzone" style="display: grid; justify-content: center; align-content: center; border: dashed 2px black; border-radius: 0.5rem; height: 10rem; width: 20rem; margin-bottom: 2rem;">
      Drop files here
    </div>

    <!-- (C) UPLOAD STATUS -->
    <div id="upstat"></div>

    <a style="text-decoration: none" href="zip.php"><button id="download" style="display:none; margin-top: 1rem; padding: 0.5rem 1rem">Download all</button></a>
    <br><br><br>

    <!-- (D) FALLBACK -->
    <form id="upform" action="dd-upload.php" method="post" enctype="multipart/form-data">
      <input style="display: none" type="file" name="upfile" accept="image/*" required>
      <input style="display: none" type="submit" value="Upload File">
    </form>
  </body>
</html>