<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
<p> Выберите Тест </p>

<?php

$NewTest=array();
$Testes=array();

if ($handle = opendir("tests/")) {
    while (false !== ($file = readdir($handle))) {
        if(strpos($file,".")!=0)
            $Testes[]= $file;
    }
    closedir($handle);
}

?>
<form enctype="multipart/form-data"  method="GET">
    <?php
    foreach ($Testes as $key=>$value){
        ?>
        <label><input type="radio"  name='name' value=<?=$value ?>><?=$value ?></label><br/>
        <?php
    }
    ?>
    <input type="submit" value="Выбрать" />
</form >

<?php

if (!empty($_GET['name'])) {

      session_start();
      $_SESSION['name']=$_GET['name'];
     /* $_SESSION['count']=$value;*/
    $filename = "tests/".$_GET['name'];
  if (file_exists($filename)) {
    header('Location:test.php');
  }else{
      header('HTTP/1.0 404 Not Found');
  }
}
?>

</body>
</html>
