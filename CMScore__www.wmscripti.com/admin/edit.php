<?
include "connect.php";
session_start();
if (isset($_SESSION['username'])) 
{ 

if (isset($_POST['editnow']))
{
    $body=$_POST['body'];
    $title=$_POST['title'];
    $shortdescription=$_POST['shortdescription'];
    $edit2 = "UPDATE CMS_articles SET body='$body' WHERE EntryID = '$id'";
    mysql_query($edit2) or die("could not edit");
    $edit3 = "UPDATE CMS_articles SET title='$title' WHERE EntryID = '$id'";
    mysql_query($edit3) or die("could not edit");
    $edit1 = "UPDATE CMS_articles SET shortdescription='$shortdescription' WHERE EntryID = '$id'";
    mysql_query($edit1) or die("could not edit");
    print "Entry Edited redirecting to admin panel <META HTTP-EQUIV = 'Refresh' Content = '2; URL =index.php'>";
} 
}
else 
{ 
   print "You are not logged in as Administrator, please log in.";
   print "<form method='POST' action='authenticate.php'>";
   print "Type Username Here: <input type='text' name='username' size='15'><br>";
   print "Type Password Here: <input type='password' name='password' size='15'><br>";
   print "<input type='submit' value='submit' name='submit'>";
   print "</form>";
} 




?>