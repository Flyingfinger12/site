<?
include "connect.php";
session_start();
if (isset($_SESSION['username']))
   {
    print "<table border='1' cellpadding='6' bgcolor='#e1e1e1'><tr><td>";
    print "<form method='post' action='addentry.php'>";
    print "<b>Name:</b><br> <input type='text' name='name' size='40'><br>";
    print "<b>Title:(Required)</b><br> <input type='text' name='title' size='40'><br>";
    print "<b>Short Description(Abstract)(Required):</b><br>";
    print "<textarea rows='6' name='ShortDescription' cols='45'></textarea><br><br>";
    print "<b>Full Article(Required):</b><br>";
    print "<textarea rows='12' name='article' cols='90'></textarea><br>";

    print "<input type='submit' name='submit' value='submit'>";

    print "</form><br>";
 



if (isset($_POST['submit']))
{
  if(!$_POST['title'] || !$_POST['ShortDescription']||!$_POST['article'])
   {
     print "<font color='red'>One of the Required Fields was not entered, Please go try again</font><br>";
   }
  else
   {
     $name=$_POST['name'];
     $title=$_POST['title'];
     $ShortDescription=$_POST['ShortDescription'];
     $article=$_POST['article'];
     $day=date("D M d, Y H:i:s");
     $timegone=date("U") ; //seconds since Jan 1st, 1970
     $cmsarticle="INSERT INTO CMS_articles(CMS_author, title, shortdescription, body,CMS_tsubmit,CMS_telapsed) VALUES('$name','$title','$ShortDescription','$article','$day','$timegone')";
     mysql_query($cmsarticle);
     print "Thanks for posting, you will now be redirected <META HTTP-EQUIV = 'Refresh' Content = '2; URL =index.php'> ";
   }

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


</td></tr></table>
</center>