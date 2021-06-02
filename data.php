<!--file data.php -->
<?php

require_once 'sqlinfo.inc.php';
// assign variable to server connection.
$conn = @mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db) or die("<p>Server connection failed !</p>");

// check database connection.

if (!$conn){

	echo "Database connection failed";
}

else
{
//creat table in the date base.
	$createQuery = "CREATE TABLE user (name VARCHAR (40) PRIMARY KEY, password VARCHAR (40), email VARCHAR (100))";
	$createTableResult = mysqli_query ($conn, $createQuery);

//insert test date into newly created table.
	$insertTableQuery = "INSERT into user Values ('oscar', 'pass01', 'osar@email.com'),
	('lee', 'pass02', 'lee@email.com'),
	('peter', 'pass03', 'peter@email.com'),
	('alice', 'pass04', 'alice@email.com'),
	('mary', 'pass05', 'mary@email.com')";

	$insertTableResult = mysqli_query ($conn, $insertTableQuery);

}

// get name and password passed from client
$name = $_POST["name"];
$pwd = $_POST["pwd"];

$sql_tble = "user";
$searchQuery = "SELECT * FROM $sql_tble WHERE name = '$name'";
$searchResult = mysqli_query ($conn, $searchQuery);
$row = mysqli_fetch_assoc($searchResult);

// pass user email when user name and password are match
	if (($name == $row ["name"]) && ($pwd == $row["password"]))
	{
		echo "User found: " .$row["email"];
	}
//test case for if incorrect password
	else if (($name == $row ["name"]) && ($pwd != $row["password"]))
	{
		echo "User found, but wrong password !!";
	}

// test case for if user is not in the data base
else {

		echo "No user found";
}

?>
