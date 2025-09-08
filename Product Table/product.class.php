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
        $save=$db->query("INSERT INTO products (name,description,price,offer_price) Values ('$this->name','$this->description','$this->price','$this->offer_price')");
        if($save){
            return "Data Saved Successfully";
        }else{
             return "Data Not Saved";
        }
    }

    public static function getall() {
         global $db;
         $data= $db->query("SELECT * FROM products");
         $html = "<table>";
           $html.="<tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Offer Price</th><th>Action</th></tr>";
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
        $delete= $db->query("DELETE FROM Products WHERE id=$_id");
        if($delete){
        return "Data Deleted Successfully";
        }else{
        return "Data Not Deleted";
        }
    }

      public function update(){
    
        global $db;
        $update= $db->query("UPDATE products SET name='$this->name', description='$this->description', price='$this->price',offer_price='$this->offer_price' WHERE id=$this->id");
        if($update){
            return "Data Updated Successfully";
        }else{
            return "Data Not Updated";
        }
    }

    public static function find($_id){
        global $db;
        $data= $db->query("SELECT * FROM products WHERE id=$_id");
        $row = $data->fetch_object();
         if($row){
           return new Product ($row->name,$row->description,$row->price,$row->offer_price,$row->id);
        }else{
            return "User Not Found";
        }

    }
}

?>
