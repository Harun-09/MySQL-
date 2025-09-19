<?php
include_once("db_config.php");

class Patient{
    public $id,$name,$age,$mobile;

    public function __construct($_name,$_age,$_mobile,$_id=null)
    {
      $this->id=$_id;
      $this->name=$_name;
      $this->age=$_age;
      $this->mobile=$_mobile;
    }

    public function save(){
        global $db;
        $save=$db->query("insert into patients(name,age,mobile) values ('$this->name','$this->age','$this->mobile')");

        if($save){
            return "Data Saved Successfully";
        }else{
            return "data Not Saved";
        }
    }


    public static function getall(){
        global $db;
        $data = $db->query("select * from patients");
         $html = "<table class='patient-table'>";
        $html.="<tr><th>Id</th><th>Name</th><th>Age</th><th>Mobile</th> <th>Actions</th></tr>";
        while($row = $data->fetch(PDO::FETCH_OBJ)){
            $html.="<tr>
            <td>{$row->id}</td>
            <td>{$row->name}</td>
            <td>{$row->age}</td>
            <td>{$row->mobile}</td>
            <td>
            <a href = 'index.php?EditId={$row->id}'>Edit</a> |
            <a href = 'index.php?id={$row->id}'>Delete</a> |
            </td>
            </tr>";

        }
        $html.="</table>";
        return $html;
    }

    public static function delete($_id){
        global $db;
        $delete=$db->query("DELETE FROM patients WHERE id=$_id");
        if($delete){
            return "Data Deleted Successfully";
        }else{
           return "Data Not Deleted";
        }

    }

     public function update(){
    
        global $db;
        $update= $db->query("UPDATE patients SET name='$this->name', age=$this->age, mobile='$this->mobile' WHERE id=$this->id");
        if($update){
            return "Data Updated Successfully";
        }else{
            return "Data Not Updated";
        }
    }

     public static function find($_id){
        global $db;
        $data= $db->query("SELECT * FROM patients WHERE id=$_id");
        $row = $data->fetch(PDO::FETCH_OBJ);
         if($row){
           return new Patient ($row->name,$row->age,$row->mobile,$row->id);
        }else{
            return "User Not Found";
        }

    }

}




?>




