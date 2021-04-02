<?
include "connect.php";
session_start();
if (isset($_SESSION['username'])) 
{ 


if (isset($_POST['submit'])) //if delete is pressed
   {
     $title=$_POST['title'];
     $sql="Select * from CMS_articles WHERE title='$title'";
     $sql2=mysql_query($sql);
       $row=mysql_fetch_array($sql2);
      if(!$row)
         {
           print "<br><br><font color='red'>No such entry</font>";
         }
       else
         {
       $result = "DELETE  FROM CMS_articles WHERE title='$title'";
       mysql_query($result);
         print "Entry Deleted, <A href='index.php'>Back to control panel</a>";
         }
   }


else if(isset($_POST['edit'])) // if edit is pressed
   {
     $title=$_POST['title'];
     $sql="Select * from CMS_articles WHERE title='$title'";
     $sql2=mysql_query($sql);
       $row=mysql_fetch_array($sql2);
      if(!$row)
         {
           print "<br><br><font color='red'>No such entry</font>";

        }
    else //if entry exists
     {
         print"<form action='edit.php' method='post'>";
         print "<input type='hidden' name='id' value='$id'>";
         print "Title: <input type='text' name='title' value='$title'><br>";
         print "Abstract:<br><textarea rows='4' name='shortdescription' cols='25'>$shortdescription</textarea><br><br>";
         print "Body:<br><textarea rows='15' name='body' cols='70'>$body</textarea><br><br>";
         print "<input type='submit' name='editnow' value='edit'>";
            
      }
    }


} 
else //if not logged in
{ 
     print "You are not logged in as Administrator, please log in.";
     print "<form method='POST' action='authenticate.php'>";
     print "Type Username Here: <input type='text' name='username' size='15'><br>";
     print "Type Password Here: <input type='password' name='password' size='15'><br>";
     print "<input type='submit' value='submit' name='submit'>";
     print "</form>";
} 




?>