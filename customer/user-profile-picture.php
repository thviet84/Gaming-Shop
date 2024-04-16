
<?php 

$select_user = mysqli_query($conn,"select * from khachhang where MSKH='$_SESSION[user_id]' ");

$fetch_user = mysqli_fetch_array($select_user);
?>
	
<div class="register_box">

  <form method = "post" action="" enctype="multipart/form-data">
    
	<table align="left" width="70%">
	
	  <tr align="left">	   
	   <td colspan="4">
	   <h2>Chỉnh sửa ảnh đại diện</h2><br />
	   
	   </td>	   
	  </tr>	  
	  
	  <tr>
	   <td width="20%"><b>Hình Đại Diện:</b></td>
	   <td colspan="3">
       <input type="file" name="HinhDaiDien"  id="file" class="inputfile" /><label for="file">Choose a file</label>
       <div>
	   <br>
       <img src="customer/customer_images/<?php echo $fetch_user['HinhDaiDien']; ?>" width="100" height="100" />
       </div>
       </td>
	  </tr>	  
	  <br>
	  <tr align="left">
	   <td></td>
	   <td colspan="4">
	   <input type="submit" name="user_profile_picture" value="Save" />
	   </td>
	  </tr>
	
	</table>
	
	
  </form>

</div>

<?php 
if(isset($_POST['user_profile_picture'])){   
 
 // Check if file not empty 
 if(!empty($_FILES['HinhDaiDien']['name'])){
 
   $HinhDaiDien = $_FILES['HinhDaiDien']['name'];
   $HinhDaiDien_tmp = $_FILES['HinhDaiDien']['tmp_name'];   
   $target_file = "customer/customer_images/" . $HinhDaiDien;   
   $uploadOk = 1;
   $message = '';  
   
   
   // Check if the file size more than 5 MB.
   if($_FILES["HinhDaiDien"]["size"] < 5098888){
  
   // Check if file already exists
   if(file_exists($target_file)){
   
    $uploadOk = 0;
	$message .=" Sorry, file already exists. ";
	
   }if($uploadOk == 0){ // Check if uploadOk is set to 0 by an error
   
    $message .="Xin lỗi, ảnh của bạn không tải lên được. ";
	
   }else{
    if(move_uploaded_file($HinhDaiDien_tmp, $target_file)){
	
	$update_HinhDaiDien = mysqli_query($conn,"update khachhang set HinhDaiDien='$HinhDaiDien' where MSKH='$_SESSION[user_id]'");
	
	$message .= "Ảnh" . basename($HinhDaiDien) . " đã được tải lên. ";
	}else{
	 $message .= "Xin lỗi, đã có lỗi xảy ra trong việc tải lên ảnh cảu bạn ! ";
	}
   }
   
   }// End if the file size more than 5 MB.
   else{
    $message .= "Kích thước ảnh lớn nhất là 5 MB. ";
   }
   
   }
  
}

?>

<p style="color:green;margin-left:15px">
<?php if(isset($message)){echo $message;} ?>
</p>





  
