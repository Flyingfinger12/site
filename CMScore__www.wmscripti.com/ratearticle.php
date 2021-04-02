<?
include "connect.php";
if(isset($_POST['submit']))
{
  $s=$_SERVER["REMOTE_ADDR"];
  $EntryID=$_POST['EntryID'];
  $rankselect=$_POST['rankselect'];
  $trackip="SELECT * FROM CMS_IP where IP='$s' and EntryID='$EntryID'"; //Checking all IP's that have already voted.
  $trackip2=mysql_query($trackip);
  while($c=mysql_fetch_array($trackip2))
  {
    $insertvar='C';
  }
  if($insertvar) //checks to see if you've already voted
  {
    print "You have already voted for this article, redirecting to article <META HTTP-EQUIV = 'Refresh' Content = '2; URL =index.php?EntryID=$EntryID'>";
  }
  else if($rankselect<1 || $rankselect >5)
  {
    print "That is an illegal Vote.";
  }
  else
  {
   
  $insertIP="INSERT into CMS_IP (EntryID,IP) VALUES('$EntryID','$s')";
  mysql_query($insertIP);
   
  $votes = "UPDATE CMS_articles SET numvotes=numvotes+1 WHERE EntryID = '$EntryID'";
    mysql_query($votes);

  $total = "UPDATE CMS_articles SET totalscore=totalscore+'$rankselect' WHERE EntryID = '$EntryID'";
  mysql_query($total);
  
  $totalscore=0;
  $totalvotes=0;
  $vote1="SELECT * FROM CMS_articles where EntryID='$EntryID'";
   $vote2=mysql_query($vote1) or die("It died");
   while($r=mysql_fetch_array($vote2))
    {
      $totalvotes=$r[numvotes];
      $totalscore=$r[totalscore];
    }
  if($totalvotes!=0)
    {
       $averagescore=$totalscore/$totalvotes;
       $avgscore = "UPDATE CMS_articles SET avgvotes='$averagescore'
		WHERE EntryID = '$EntryID'";
       mysql_query($avgscore);
    }
  print "Thanks for voting redirecting to article....<META HTTP-EQUIV = 'Refresh' Content = '2; URL =index.php?EntryID=$EntryID'>";

       
}
  
}



?>


