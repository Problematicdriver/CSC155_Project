<html>
<head>
<title>CSC155 001DR Survey Thing</title>
<link rel="stylesheet" type="text/css" href="library/styles.css">
<?php

require ('library/functions.php');

// depending on the zone, call one of
//checkAccount("none");
//checkAccount("user");
checkAccount("admin");

// get connection object
$conn = getDBConnection();

// handle which button got us here
if ($_POST['selection'] == 'Edit')
{
    $result = lookupuserNameByID($conn, $_POST['id']);
    if (!$result)
    {
        header('Location: showAccounts.php');
    }
    $row = $result->fetch_assoc();
}
else if ($_POST['selection'] == 'Reset Changes')
{
    $result = lookupuserNameByID($conn, $_POST['id']);
    if (!$result)
    {
        header('Location: showAccounts.php');
    }
    $row = $result->fetch_assoc();
}
else if ($_POST['selection'] == 'Apply Changes')
{
    $result = lookupuserNameByID($conn, $_POST['id']);
    if (!$result)
    {
        header('Location: showAccounts.php');
    }
    updateUserRecord($conn);
    header('Location: showAccounts.php');
}
else if ($_POST['selection'] == 'Cancel')
{
    header('Location: showAccounts.php');
}
else
{
    header('Location: showAccounts.php');
}

?>
</head>
<body>

<form method='POST'>
    <input type='hidden' name='id' value='<?php echo showPost('id'); ?>' />
<div style='border-width: 2px'>
<table id='userform'>
<tr>
  <td>Username</td>
  <td><?php echo $row["username"]; ?></td>
</tr>
<tr>
  <td>Email</td>
  <td> <input type='text' name='email' value='<?php echo $row["email"]; ?>'/></td>
</tr>
<tr>
  <td>Address1</td>
  <td> <input type='text' name='address1' value='<?php echo $row["address1"]; ?>'/></td>
</tr>
<tr>
  <td>Address2</td>
  <td> <input type='text' name='address2' value='<?php echo $row["address2"]; ?>'/></td>
</tr>
<tr>
  <td>City</td>
  <td> <input type='text' name='city' value='<?php echo $row["city"]; ?>'/></td>
</tr>
<tr>
  <td>State</td>
  <td> <input type='text' name='state' value='<?php echo $row["state"]; ?>'/></td>
</tr>
<tr>
  <td>Zipcode</td>
  <td> <input type='text' name='zip' value='<?php echo $row["zip"]; ?>'/></td>
</tr>
<tr>
  <td colspan='2' style='text-align: center; background-color: white;'>
    <input type='submit' name='selection' value='Apply Changes' />
    &nbsp;
    <input type='submit' name='selection' value='Reset Changes' />
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

