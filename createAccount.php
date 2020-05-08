<html>
<head>
<title>CSC155 001DR Survey Thing</title>
<link rel="stylesheet" type="text/css" href="library/styles.css">
<?php

require ('library/functions.php');

// depending on the zone, call one of
checkAccount("none");
//checkAccount("user");
//checkAccount("admin");

// get connection object
$conn = getDBConnection();

if (isset($_POST['selection'])) // form loaded itself
{
    if ($_POST['selection'] == "Create Account") // insert new record chosen
    {
	if ($_POST['password'] == $_POST['confirm'])
        {
	    // build SQL command SECURELY
            // prepare
	    $stmt = $conn->prepare("INSERT INTO users 
                       (username,firstname, lastname, encrypted_password, usergroup, email) 
                       VALUES (?, ?, ?, ?, ?, ?)" );
	    // bind variable names and types
	    $stmt->bind_param("ssssss", $username, $firstname, $lastname, $encrypted_password, 
                                  $usergroup, $email);

	    $username=$_POST['username'];
	    $firstname=$_POST['firstname'];
            $lastname=$_POST['lastname'];
	    $encrypted_password=password_hash($_POST['password'], 
                                          PASSWORD_DEFAULT);
	    $usergroup=$_POST['usergroup'];
	    $email=$_POST['email'];

	    // put the statement together and send it to the database
	    $result=$stmt->execute();
	    if ($result) {
                header("Location: welcome.php");
            } else {
                displayError("Username existed");
            }
	}
	else 
	{
	    displayError("Passwords don't match");
        }
	    
    }
    if ($_POST['selection'] == "Cancel") // insert new record chosen
    {
        header("Location: welcome.php");
    }
}
?>

</head>
<body>

<form method='POST'>
<div style='border-width: 2px'>
<table id='userform'> 
<tr>
  <td>Username</td>
  <td><input type='text' name='username' /></td>
</tr>
<tr>
  <td>First name</td>
  <td><input type='text' name='firstname' value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname']?>"/></td>
</tr>
<tr>
  <td>Last name</td>
  <td><input type='text' name='lastname' value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname']?>"/></td>
</tr>
<tr>
  <td>Password</td>
  <td><input type='password' name='password' /> </td>
</tr>
<tr>
  <td>Confirm Password</td>
  <td> <input type='password' name='confirm' /></td>
</tr>
<tr>
  <td>Email</td>
  <td> <input type='text' name='email' /> </td>
</tr>
<tr>
  <td>Usergroup</td>
  <td>
    <input type="radio" id= "user" name="usergroup" value="user" checked> <label for="user">User</label>
    <input type="radio" id= "admin" name="usergroup" value="admin"> <label for="admin">Admin</label>
    <input type="radio" id= "su" name="usergroup" value="su"> <label for="su">Super user</label>
  </td>
</tr>
<tr>
  <td colspan='2' style='text-align: center; background-color: white;'> 
    <input type='submit' name='selection' value='Create Account' />
    &nbsp;
    <input type='submit' name='selection' value='Cancel' />
  </td>
</tr>
<tr>
  <td colspan='2' style='text-align: center; background-color: lightred;'>
    Warning: This is class project and is not secure!  
  </td>
</tr>
</table>
</div>
</form>

</body>
</html>
