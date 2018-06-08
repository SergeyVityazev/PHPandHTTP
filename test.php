<!DOCTYPE HTML>
<html>
<head>
</head>
<body>

<?php
/*phpinfo(32);*/
session_start();
$NumberTest=$_SESSION['name'];
//$NumberTest='test2.json';
echo "Вы выбрали тест ".$NumberTest;
$TestText=file_get_contents("tests/".$NumberTest);
$DecodeTestText=json_decode($TestText,true);

echo $DecodeTestText;
$stop=false;
$N=1;
$M=0;
?>
<form  method="POST">
    <p>Введите Ваше имя</p>
    <label><input type="text" name="UserName"></label>
    <?php
    foreach ($DecodeTestText as $test) {
        foreach ($test as $inner_key => $questions) {
            if (is_string($questions))
                continue;

            foreach ($questions as $InInner_key => $question) {
                if ($InInner_key == "content") {
                    echo "<br/>";
                    echo $question ;
                    echo "<br/>";
                } elseif ($InInner_key !== "nameQ") {
                    ?>
                    <label><input type="radio" name=<?= (string)$N ?>> <?= $question ?></label>
                    <?php
                    $massivAnswer[] = $InInner_key;
                    $N = $N + 1;
                }
            }
        }break;
    }
    ?>

    <br/>
    <input type="submit" value="Отправить" />

</form >


<?php
$right=0;
$Noright=0;
if (!empty($_POST)) {
    echo "<br/>";
    $N = $N - 2;
    for ($i = 0; $i <= $N; $i++) {
        if (!empty($_POST[$i+1])) {
            if ($massivAnswer[$i] == "yes")
                $right = $right + 1;
            else
                $Noright = $Noright + 1;
        }
    }
    $_SESSION['right']=$right;
    $_SESSION['Noright']=$Noright;
    $_SESSION['UserName']=$_POST['UserName'];
    header('Location:Result.php');
}
?>

</body>
</html>
