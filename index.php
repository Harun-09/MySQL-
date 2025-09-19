<?php
include_once("sqlite.class.php");
if(isset($_POST['btn_submit'])){
    $name=$_POST['name'];
    $age=$_POST['age'];
    $mobile=$_POST['mobile'];
    $patient = new Patient($name,$age,$mobile);
    $save = $patient->save();
    if ($save){
        echo $save;
        unset($_POST['name']);
        unset($_POST['age']);
        unset($_POST['mobile']);
    }
}

if(isset($_GET['id'])){
    $id=$_GET['id'];
    Patient::delete(($id));
}

if(isset($_POST['btn_update'])){
    $id = $_POST['id'];
    $name=$_POST['name'];
    $age=$_POST['age'];
    $mobile=$_POST['mobile'];
    $patient = new Patient($name,$age,$mobile,$id);
    $update = $patient->update();
    if ($update){
        echo $update;
        unset($_POST['name']);
        unset($_POST['age']);
        unset($_POST['mobile']);
    }
}


$search_patient=null;
if(isset($_GET['EditId'])){
    $id=$_GET['EditId'];
    $search_patient= Patient::find($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
  <style>
        body{
            display: flex;
            place-content: center;
            gap:20px;
        }

        table,th,td{
            border-collapse:collapse;
            border:1px solid black;
            padding: 10px;
        }

        tr:nth-child(even){
            background-color: lightgray;
        }
        .patient-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 16px;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.patient-table th {
    background-color: #4CAF50;
    color: white;
    padding: 12px;
}

.patient-table td {
    border: 1px solid #ddd;
    padding: 10px;
}

.patient-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.patient-table tr:hover {
    background-color: #ddd;
}

.btn-edit {
    color: #0a7cff;
    text-decoration: none;
    font-weight: bold;
}

.btn-edit:hover {
    text-decoration: underline;
}

.btn-delete {
    color: red;
    text-decoration: none;
    font-weight: bold;
}

.btn-delete:hover {
    text-decoration: underline;
}

    </style>
<body>
    <div>
        <h1>Patient Table</h1>
        <a href="index.php">New Patient</a>
        <?php
        echo Patient::getall();
        ?>
    </div>
    <?php
    if(is_null($search_patient)){
        ?>
        <div>
            <h1>New Patient</h1>
            <form action="" method="post">
                <label for="name">Name</label><br>
                <input type="text" name="name" id="name"><br><br>
                <label for="age">Age</label><br>
                <input type="text" name="age" id="age"><br><br>
                <label for="mobile">Mobile</label><br>
                <input type="text" name="mobile" id="mobile"><br><br>
                <input type="submit" name="btn_submit" value="Submit">
            </form>
        </div>
        <?php

    }else{
        ?>
        <div>
             <h1>Update Patient</h1>
            <form action="" method="post">
                <label for="id">Id</label><br>
                <input type="text" name="id" id="id" value="<?php echo $search_patient->id?>"><br><br>
                <label for="name">Name</label><br>
                <input type="text" name="name" id="name" value="<?php echo $search_patient->name?>"><br><br>
                <label for="age">Age</label><br>
                <input type="text" name="age" id="age" value="<?php echo $search_patient->age?>"><br><br>
                <label for="mobile">Mobile</label><br>
                <input type="text" name="mobile" id="mobile" value="<?php echo $search_patient->mobile?>"><br><br>
                <input type="submit" name="btn_update" value="Submit">
            </form>
        </div>

        <?php
    }
    ?>
    
</body>
</html>