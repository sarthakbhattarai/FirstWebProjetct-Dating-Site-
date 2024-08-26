<?php
$Username=$_POST['Username'];
$email=$_POST['email'];
$Phone=$_POST['Phone'];
$Password=$_POST['Password'];
if(!empty($Username)  || !empty($email) || !empty($Phone) || !empty($Password)){
    $host = "localhost";
    $dbUsername="root";
    $dbPassword="";
    $dbname="register";

    $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
    if(mysqli_connect_error()){
        die('Connect Error (' . mysqli_connect_error().')'.mysqli_connect_error());
}else{
    $SELECT =  "SELECT email from register where email=? limit=1";
    $INSERT = "INSERT into register(Username,email,Phone,Password) values (?,?,?,?)";

    $stm = $conn ->prepare($SELECT);
    $stm-> bind_param("s",$email);
    $stm-> execute();
    $stm->bind_result($email);
    $stm->store_result();
    $rnum = $stm->num_rows; 
    if($rnum==0){
        $stm->close();

        $stm = $conn ->prepare($INSERT);
        $stm-> bind_param("ssis",$Username,$email,$Phone,$Password);
        $stm-> execute();
        echo "Your Data is Registered Sucessfully";
}
 else{
    echo "Your data is already in used";
 }
 $stm-> close();
 $conn-> close();
}
 
}else{
    echo"All field required";
    die();
}
    
?>