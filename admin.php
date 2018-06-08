
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<form enctype="multipart/form-data"  method="POST">
    Choose a file to upload: <input name="inputfile" type="file" /><br />
    <input type="submit" value="Upload File" />
</form>
</body>
</html>

<?php
$uploads_dir = '/tests';
if (!empty($_FILES))
    load();

function load()
{

    if (isset($_FILES) && $_FILES['inputfile']['error'] == 0) { // Проверяем, загрузил ли пользователь файл
        $name=basename($_FILES['inputfile']['name']);
        if (move_uploaded_file($_FILES['inputfile']['tmp_name'],"tests/".$name)==true) {
            echo 'File Uploaded'; // Оповещаем пользователя об успешной загрузке файла
            header('Location:list.php');
        }// РЕДИРЕКТ ПОСЛЕ УСПЕШНОЙ ЗАГРУЗКИ ТЕСТА
        else
            echo 'File Not uploaded';
    } else {
        echo 'No File Uploaded'; // Оповещаем пользователя о том, что файл не был загружен
    }
}
?>