<?php
include_once("db_config.php");
class Product{
    public $id,$name,$description,$price,$offer_price;

    public function __construct($_name,$_description,$_price,$_offer_price,$_id=null)
    {
       $this->id=$_id; 
       $this->name=$_name; 
       $this->description=$_description; 
       $this->price=$_price; 
       $this->offer_price=$_offer_price; 
    }

    public function save(){
        global $db;
        $stmt=$db->prepare("INSERT INTO products (name,description,price,offer_price) VALUES (?,?,?,?)");
        $stmt->bind_param("ssdd",$this->name,$this->description,$this->price,$this->offer_price);
        $save=$stmt->execute();
        return $save ? "Data Saved Successfully" : "Data Not Saved";
    }

    public static function getall(){
        global $db;
        $stmt =$db->prepare("SELECT * FROM products");
        $stmt->execute();
        $data=$stmt->get_result();
        $html="<table>";
        $html.="<tr><th>ID</th><th>Name</th><th>Description</th><th>price</th><th>offer Price</th><th>Action</th></tr>";
       while($row=$data->fetch_object()) {
        $html.="<tr>
        <td>{$row->id}</td>
        <td>{$row->name}</td>
        <td>{$row->description}</td>
        <td>{$row->price}</td>
        <td>{$row->offer_price}</td>
        <td>
        <a href ='index.php?EditId={$row->id}'>Edit</a> |
        <a href = 'index.php?id={$row->id}'>Delete</a>
        </td>
        </tr>";

       }
       $html.="</table>";
       return $html;
    }

    public static function delete($_id){
        global $db;
        $stmt=$db->prepare("DELETE FROM products WHERE id=?");
        $stmt->bind_param("i",$_id);
        $delete=$stmt->execute();
        return $delete ? "Data Deleted Successfully" : "Data Not Deleted";
    }

    public function update(){
        global $db;
        $stmt=$db->prepare("UPDATE products SET name=?,description=?,price=?,offer_price=? WHERE id=?");
        $stmt->bind_param("ssddi",$this->name,$this->description,$this->price,$this->offer_price,$this->id);
        $update =$stmt->execute();
        return $update ? "Data Update Successfully" : "Data Not Updated";
    }

    public static function find($_id){
        global $db;
        $stmt=$db->prepare("SELECT * FROM products WHERE id=?");
        $stmt->bind_param("i",$_id);
        $stmt->execute();
        $result=$stmt->get_result();
        $row=$result->fetch_object();
        if($row){
           return new Product ($row->name,$row->description,$row->price,$row->offer_price,$row->id);
        }else{
            return "User Not Found";
        }

    }
    
}
?>