<?php
include_once("product.class.php");
if(isset($_POST['btn_submit'])){
    $name=$_POST['name'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $offer_price=$_POST['offer_price'];

    $product = new Product($name,$description,$price,$offer_price);
    $save = $product->save();
    if ($save){
        echo $save;

        unset($_POST['name']);
        unset($_POST['description']);
        unset($_POST['price']);
        unset($_POST['offer_price']);
    }
}

if(isset($_GET['id'])){
    $id=$_GET['id'];
    Product::delete(($id));
}

if(isset($_POST['btn_update'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $description=$_POST['description'];
    $price =$_POST['price'];
    $offer_price=$_POST['offer_price'];

    $product = new Product ($name,$description,$price,$offer_price,$id);
    $update = $product->update();
    if($update){
        echo $update;
        unset($_POST['id']);
        unset($_POST['name']);
        unset($_POST['description']);
        unset($_POST['price']);
        unset($_POST['offer_price']);
    }

}

$search_product=null;
if(isset($_GET['EditId'])){
    $id=$_GET['EditId'];
    $search_product= Product::find($id);
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
        <h1>Product Table</h1>
        <a href="index.php">New Product</a>
        <?php
        echo Product::getall();
        ?>
    </div>
    <?php
    if(is_null($search_product)){

        ?>
        <div>
   <h1>New Product</h1>
    <form action="" method="post">
        <label for="name">Name</label><br>
        <input type="text" name="name" id="name"><br><br>
        <label for="description">Description</label><br>
        <input type="text" name="description" id="description"><br><br>
        <label for="price">Price</label><br>
        <input type="number" step="any" name="price" id="price"><br><br>
        <label for="offer_price">Offer Price</label><br>
        <input type="number" name="offer_price" id="offer_price" step="any"><br><br>
        <input type="submit" name="btn_submit" value="Submit">
    </form>
    </div>
    <?php

    }else{
        ?>
        <div>
            <h1>Update Product</h1>
            <form action="" method="post">
                <label for="id">Id</label><br>
                <input type="text" name="id" id="id" value="<?php echo $search_product->id?>"><br><br>
                <label for="name">Name</label><br>
                <input type="text" name="name" id="name" value="<?php echo $search_product->name?>"><br><br>
                <label for="description">Description</label><br>
                <input type="text" name="description" id="description" value="<?php echo $search_product->description?>"><br><br>
                <label for="price">Price</label><br>
                <input type="number" step="any" name="price" id="price" value="<?php echo $search_product->price?>"><br><br>
                <label for="offer_price">Offer Price</label><br>
                <input type="number" step="any" name="offer_price" id="offer_price" value="<?php echo $search_product->offer_price?>"><br><br>
                <input type="submit" name="btn_update" value="Submit">
            </form>
        </div>

        <?php
    }
    ?>
    
</body>
</html>