<?php
include_once("user.class.php");

if (isset($_POST["btn_Submit"])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
   $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$image = null;
if (isset($_FILES['image'])) {
    $file = $_FILES['image'];
    $fileTmp = $file['tmp_name'];
    $folder = "uploads/";

    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION); 
    $imgName = "profile_" . time();
    $image = $imgName . "." . $ext;

    move_uploaded_file($fileTmp, $folder . $image);
}
    $role_id = $_POST['role_id'];

    $user = new User($name, $email, $password, $image, $role_id);
    $save = $user->save();

    if ($save) {
        echo $save;

        unset($_POST['name']);
        unset($_POST['email']);
        unset($_POST['password']);
        unset($_POST['image']);
        unset($_POST['role_id']);
    }
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    echo User::delete($id);
}

if (isset($_POST['btn_update'])) {
  $id = intval($_POST['id']);

    $name = $_POST['name'];
    $email = $_POST['email'];
   if (!empty($_POST['password'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
} else {
    $password = $_POST['old_password'];
}

$image = null;
if (isset($_FILES['image'])) {
    $file = $_FILES['image'];
    $fileTmp = $file['tmp_name'];
    $folder = "uploads/";

    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION); // extension ber korlam
    $imgName = "profile_" . time(); // custom name logic
    $image = $imgName . "." . $ext;

    move_uploaded_file($fileTmp, $folder . $image);
}
    $role_id = $_POST['role_id'];

    $user = new User($name, $email, $password, $image, $role_id, $id);
    $update = $user->update();

    if ($update) {
        echo $update;
        unset($_POST['name']);
        unset($_POST['email']);
        unset($_POST['password']);
        unset($_POST['image']);
        unset($_POST['role_id']);
    }
}

$search_user = null;
if (isset($_GET['EditId'])) {
    $id = $_GET['EditId'];
    $search_user = User::find($id);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: flex;
            place-content: center;
            gap: 20px;
        }

        table,
        th,
        td {
            border-collapse: collapse;
            border: 1px solid black;
            padding: 10px;
        }

        tr:nth-child(even) {
            background-color: lightgrey;
        }
    </style>
</head>

<body>
    <div>
        <h1>Users Table </h1>

        <a href="manage.php">New Users</a>
        <?php
        echo  User::getall();
        ?>
    </div>

    <?php
    if (is_null($search_user)) {



    ?>

        <div>
            <h1> New Users</h1>
            <form action="" method="POST" enctype="multipart/form-data">


                <label for="n">Name</label> <br>
                <input type="text" name="name" id="name"> <br> <br>
                <label for="n">Email</label> <br>
                <input type="text" name="email" id="email"> <br> <br>
                <label for="n">Password</label> <br>
                <input type="password" name="password" id="password"> <br> <br>
                <label for="n">Image</label> <br>
                <input type="file" name="image" id="image"> <br> <br>
                <label for="role">Select Role:</label><br>
                <select name="role_id" id="role_id">
                    <option value="1">Admin</option>
                    <option value="2">Editor</option>
                    <option value="3">Viewer</option>
                </select>
                <br><br>
                <input type="submit" name="btn_Submit">
            </form>
        </div>
    <?php

    } else {



    ?>

        <div>
            <h1> Update Users</h1>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="n">Id</label> <br>
                <input type="text" name="id" id="id" value="<?php echo $search_user->id ?>"> <br> <br>
                <label for="n">Name</label> <br>
                <input type="text" name="name" id="name" value="<?php echo $search_user->name ?>"> <br> <br>
                <label for="n">Email</label> <br>
                <input type="text" name="email" id="email" value="<?php echo $search_user->email ?>"> <br> <br>
                <label for="n">Password</label> <br>
                <label for="n">Password</label> <br>
                <input type="password" name="password" id="password" placeholder="Enter new password"> <br> <br>
                <input type="hidden" name="old_password" value="<?php echo $search_user->password ?>">
                 <br> <br>
                <label for="n">Image</label> <br>
                 <input type="file" name="image"><br>
                 <input type="hidden" name="old_image" value="<?php echo $search_user->image ?>">
                <img src="uploads/<?php echo $search_user->image ?>" width="80"><br><br>

                <label for="role">Select Role:</label><br>
                <select name="role_id" id="role_id">
                    <option value="1" <?php echo ($search_user && $search_user->role_id == 1) ? 'selected' : ''; ?>>Admin</option>
                    <option value="2" <?php echo ($search_user && $search_user->role_id == 2) ? 'selected' : ''; ?>>Editor</option>
                    <option value="3" <?php echo ($search_user && $search_user->role_id == 3) ? 'selected' : ''; ?>>Viewer</option>
                </select><br><br>
                <input type="submit" name="btn_update" value="Update">
            </form>
        </div>


    <?php } ?>






</body>

</html>