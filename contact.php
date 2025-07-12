<?php
include "db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name    = $_POST['name'];
  $phone   = $_POST['phone'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  /* --- Using Normal Query  
  $sql = "INSERT INTO contacts(name,contactno,address)  
     VALUES ('$name', '$contactno', '$address')";
  if ($conn->query($sql) === TRUE) {
     */

 /*    // --- Using Parameterised Query  
 // i = integer, d = double, s = string,b = blob (binary data)
  $query = "INSERT INTO contacts (name, phone, email) VALUES (?, ?, ?)";
  $sql = $conn->prepare($query);
  $sql->bind_param("sss", $name, $phone, $email);
*/

//  Using the stored procedure call
$sql = $conn->prepare("CALL usp_contacts(?,?,?,?)");
$sql->bind_param("sdss",$name, $phone, $email,$message); 

  if ($sql->execute()) {
    echo "<script>alert('Message sent successfully!'); 
    window.history.back();</script>";

  } else {
    echo "<script>alert('Error saving message.'); window.history.back();</script>";
  }
  $conn->close();
}
?>

