<?php
include_once("customer.class.php");
if(isset($_POST['btn_submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $mobile=$_POST['mobile'];

    $customer = new Customer($name,$email,$address,$mobile);
    $save = $customer->save();
    if ($save){
        echo $save;

        unset($_POST['name']);
        unset($_POST['email']);
        unset($_POST['address']);
        unset($_POST['mobile']);
    }
}

if(isset($_GET['id'])){
    $id=$_GET['id'];
    Customer::delete(($id));
}

if(isset($_POST['btn_update'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $address =$_POST['address'];
    $mobile=$_POST['mobile'];

    $customer = new Customer ($name,$email,$address,$mobile,$id);
    $update = $customer->update();
    if($update){
        echo $update;
        unset($_POST['id']);
        unset($_POST['name']);
        unset($_POST['email']);
        unset($_POST['address']);
        unset($_POST['mobile']);
    }

}

$search_customer=null;
if(isset($_GET['EditId'])){
    $id=$_GET['EditId'];
    $search_customer= Customer::find($id);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    </style>
</head>
<body>
    <div>
        <h1>Customer Table</h1>
        <a href="index.php">New Customer</a>
        <?php
        echo Customer::getall();
        ?>
    </div>
    <?php
    if(is_null($search_customer)){

        ?>
        <div>
   <h1>New Customer</h1>
    <form action="" method="post">
        <label for="name">Name</label><br>
        <input type="text" name="name" id="name"><br><br>
        <label for="email">Email</label><br>
        <input type="text" name="email" id="email"><br><br>
        <label for="address">Address</label><br>
        <input type="text" name="address" id="address"><br><br>
        <label for="mobile">Mobile</label><br>
        <input type="text" name="mobile" id="mobile"><br><br>
        <input type="submit" name="btn_submit" id="" value="Submit">
         </form>
    </div>
    <?php

    }else{
        ?>
        <div>
            <h1>Update Customer</h1>
            <form action="" method="post">
                <label for="id">Id</label><br>
                <input type="text" name="id" id="id" value="<?php echo $search_customer->id?>"><br><br>
                <label for="name">Name</label><br>
                <input type="text" name="name" id="name" value="<?php echo $search_customer->name?>"><br><br>
                <label for="email">Email</label><br>
                <input type="text" name="email" id="email" value="<?php echo $search_customer->email?>"><br><br>
               <label for="address">Address</label><br>
               <input type="text" name="address" id="address" value="<?php echo $search_customer->address?>"><br><br>
              <label for="mobile">Mobile</label><br>
              <input type="text" name="mobile" id="mobile" value="<?php echo $search_customer->mobile?>"><br><br>
             <input type="submit" name="btn_update" id="" value="Submit">
         </form>
    </div>
    <?php
    }
    ?>
</body>
</html>

                