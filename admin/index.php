<?
include "connect.php";
session_start();
if (isset($_SESSION['username']))
   {
     print "<center><h3>CMS Admin</h3></center><br>";
     print "<center>";
     print "<table border='0' width='70%' cellspacing='20'>";
     print "<tr><td width='25%' valign='top'>";
     include 'left.php';
     print "</td>";
     print "<td valign='top' width='75%'>";
     print "Here are the function of CMS admin<br><br>";
     print "Add Article -- Lets you add an Article<br><br>";
     print "Modify Article -- this basically lets you browse the articles as admin, when you click on 'read more' and view the full article, you will be given the choice to edit and delete<br><br>";
     print "Delete by date -- This allows you to prune articles over X days old"; 
     print "</td></tr></table>";    
     print "</center>";
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
    
   