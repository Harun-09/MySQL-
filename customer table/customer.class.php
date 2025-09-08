<?php
include_once("db_config.php");

class Customer{
    public $id,$name,$email,$address,$mobile;

    public function __construct($_name,$_email,$_address,$_mobile,$_id=null)
    {
         $this->id=$_id; 
         $this->name=$_name;
         $this->email=$_email;
         $this->address=$_address;
         $this->mobile=$_mobile;
    }

    public function save(){
        global $db;
        $save=$db->query("INSERT INTO customers (name,email,address,mobile) values ('$this->name','$this->email','$this->address','$this->mobile')");
         if($save){
            return "Data Saved Successfully";
        }else{
             return "Data Not Saved";
        }
    }

    public static function getall() {
         global $db;
         $data= $db->query("SELECT * FROM customers");
         $html = "<table>";
           $html.="<tr><th>ID</th><th>Name</th><th>Email</th><th>Address</th><th>Mobile</th><th>Action</th></tr>";
       while($row=$data->fetch_object()) {
        $html.="<tr>
        <td>{$row->id}</td>
        <td>{$row->name}</td>
        <td>{$row->email}</td>
        <td>{$row->address}</td>
        <td>{$row->mobile}</td>
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
        $delete= $db->query("DELETE FROM customers WHERE id=$_id");
        if($delete){
        return "Data Deleted Successfully";
        }else{
        return "Data Not Deleted";
        }
    }

     public function update(){
    
        global $db;
        $update= $db->query("UPDATE customers SET name='$this->name', email='$this->email', address='$this->address',mobile='$this->mobile' WHERE id=$this->id");
        if($update){
            return "Data Updated Successfully";
        }else{
            return "Data Not Updated";
        }
    }

     public static function find($_id){
        global $db;
        $data= $db->query("SELECT * FROM customers WHERE id=$_id");
        $row = $data->fetch_object();
         if($row){
           return new Customer ($row->name,$row->email,$row->address,$row->mobile,$row->id);
        }else{
            return "User Not Found";
        }

    }

}

?>