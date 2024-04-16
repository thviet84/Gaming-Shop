<?php
    $con = mysqli_connect("localhost","root","","quanlybanhang");
    
    if (mysqli_connect_errno())
    {
        echo "Ket noi bi loi: ".mysqli_connect_error();
    }
    
    mysqli_query($con, "SET NAMES 'utf8' ");

?>
