<?php
include_once ("db_config.php");

class User{
public $id;
public $name;
public $email;
public $password;
public $image;
public $role_id;


public function __construct($_name, $_email, $_password, $_image, $_role_id, $_id = null)
{
    $this->id =$_id;
    $this->name =$_name;
    $this->email =$_email;
    $this->password =$_password;
    $this->image =$_image;
    $this->role_id =$_role_id;

}

public function save(){
    global $db;
    $stmt = $db->prepare("INSERT INTO users (name, email, password, image, role_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $this->name, $this->email, $this->password, $this->image, $this->role_id);
    $save = $stmt->execute();
    return $save ? "Data Saved Successfully" : "Data Not Saved";
}  



public static function getall(){

    global $db;
    $data= $db->query("SELECT * FROM users");
    $html = "<table>";
    $roles = [
    1 => 'Admin',
    2 => 'Editor',
    3 => 'Viewer'
];
    $html .= "<tr><th>ID</th><th>Name</th><th>Email</th><th>Image</th><th>Role ID</th><th>Action</th></tr>";
    while ($row = $data->fetch_object()) {
       $role_name = isset($roles[$row->role_id]) ? $roles[$row->role_id] : 'Unknown';
   $html .= "<tr>
    <td>{$row->id}</td>
    <td>{$row->name}</td>
    <td>{$row->email}</td>
    <td><img src='uploads/{$row->image}' width='50' height='50'></td>
    <td>{$role_name}</td>
    <td>
        <a href='manage.php?EditId={$row->id}'>Edit</a> |
        <a href='manage.php?id={$row->id}' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a>
    </td>
</tr>";
    }
    $html .= "</table>";
    return $html;
}

public static function delete($_id){
    global $db;
    $stmt = $db->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i", $_id);
    $delete = $stmt->execute();
    return $delete ? "Data Deleted Successfully" : "Data Not Deleted";
}


public function update(){
    global $db;
    $stmt = $db->prepare("UPDATE users SET name=?, email=?, password=?, image=?, role_id=? WHERE id=?");
    $stmt->bind_param("ssssii", $this->name, $this->email, $this->password, $this->image, $this->role_id, $this->id);
    $update = $stmt->execute();
    return $update ? "Data Updated Successfully" : "Data Not Updated";
}


 public static function find($_id){
    global $db;
    $stmt = $db->prepare("SELECT * FROM users WHERE id=?");
    $stmt->bind_param("i", $_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_object();
    if($row){
        return new User($row->name, $row->email, $row->password, $row->image, $row->role_id, $row->id);
    }else{
        return "User Not Found";
    }
}

    public function __toString()
    {
        return "User: {$this->name}, Email: {$this->email}, Role ID: {$this->role_id}";
    }





}




?>