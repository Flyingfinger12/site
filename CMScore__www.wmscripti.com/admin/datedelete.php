<?
include "connect.php";
session_start();
if (isset($_SESSION['username']))
   {
     print "<center><h3>CMS Admin--Delete by date</h3></center><br>";
     print "<center>";
     print "<table border='0' width='70%' cellspacing='20'>";
     print "<tr><td width='25%' valign='top'>";
     include 'left.php';
     print "</td>";
     print "<td valign='top' width='75%'>";
     print "Delete Entries over How many days old?<br>";
     print "<form method='post' action'datedelete.php'><input type='text' name='numdays' size='6'>";
     print "<input type='submit' name='submit' value='submit'>";
     print "</form>";
     if (isset($_POST['submit']))
       {
        $numdays=$_POST['numdays'];
        $numsecs=$numdays*86400;
        $nowtime=date("U");
        $deltime=$nowtime-$numsecs;
        $SQL = "DELETE  FROM CMS_articles WHERE CMS_telapsed<'$deltime'";
        mysql_query($SQL);
       
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
    
   