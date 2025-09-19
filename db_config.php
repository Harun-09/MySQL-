<?php
try {
    $db = new PDO("sqlite:db.sqlite", "","",[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);
}catch(PDOException $ex){
    echo $ex->getMessage();
}

// $db->query("
// create table patients(
// id integer primary key autoincrement,
// name text not null,
// age integer,
// mobile text
// );
// ");

// $db->query("
// insert into patients values
// (null,'hamja',25,'013454'),
// (null,'hamja',25,'013454'),
// (null,'hamja',25,'013454'),
// (null,'hamja',25,'013454'),
// (null,'hamja',25,'013454'),
// (null,'hamja',25,'013454');
// ");

// $data = $db->query("select*from patients");
// print_r($data->fetchAll());

?>