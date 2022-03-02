<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php
//połączenie bazy danych (host, login, hasło, baza)
$db = new mysqli ('localhost','root','','shopinglist');

//Sprawdź czy otrzymałeś dane z formularza
if(isset($_REQUEST['newThing']) && $_REQUEST['newThing'] !=""){
    echo "Dodaj do listy";
    $q = $db ->prepare("INSERT INTO list VALUES (NULL, ?)");
    $q->bind_param('s', $_REQUEST['newThing']);
    $q->execute();
}


//ręcznie szykujemy kwerendę 
$q = "SELECT * FROM list";
//pobieramy wynik działania kwerendy $q
$_result = $db->query($q);
//wyciągmy jeden wiersz z wyniku 
//$row = $_result->fetch_assoc();
//wyświetl pozycję z listy zakupów
//echo $row['text'];

echo '<ul>';
while($row = $_result->fetch_assoc()) {
    echo '<li>';
    echo $row['text'];
    echo '</li>';
}
echo '</ul>';

?>
<form action="shop.php" method="get">
<label for="newThing">Dodaj do listy:</label>
<input type="text" name="newThing" id="newThing">
<input type="submit" value="Dodaj">
</form>

<?php
//debug, testy
echo '<pre>';
//var_dump($row);
?>
</body>
</html>