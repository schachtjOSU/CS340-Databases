<?php
// Turn on the error reporting
ini_set('display_errors', 'On');
// Get the location of database and all the password stuff from a different file
include('../connection-mysql.php');
//if(!$dbcon || $dbcon->connect_errno){
//	echo "Connection error " . $mysqldb->connect_errno . " " . $mysqldb->connect_error;
//	}	
// Use variable id to equal the post from the form
$id = $_POST['IngredUpdate'];
//$name = $_POST['UpdateName'];
// Update Ingredient value(name) from IngredientAdd.php's form
if(!($state = $dbcon->prepare("UPDATE ingredient SET InName= ? WHERE InNum=$id"))){
	echo "Prepare failed: "  . $state->errno . " " . $state->error;
}
// Bind the result, send an error if the bind failed.
if(!($state->bind_param("s",$_POST['UpdateName']))){
	echo "Bind failed: "  . $state->errno . " " . $state->error;
}
// Execute the statement, send an error if it failed or state a row was added.
if(!$state->execute()){
	echo "Execute failed: "  . $state->errno . " " . $state->error;
} else {
	echo "Updated " . $state->affected_rows . " rows to Ingredient table.";
}
?>
<!-- Ways to navigate back to the page to add another beer or back to the Home page -->
<p><a href="../ingredients/IngredientAdd.php">Add or Update another ingredient?</a></p>
<p><a href="../main.html">Home Page</a></p>