
<?
//CMS core 
//Core code for content management system
include "connect.php";
include "title.php";
include "admin/variables.php";
print "<body link=$link>";
print "<body vlink=$vlink>";
if(isset($_GET['EntryID'])) //If looking at a specific Article
  {
    $EntryID=$_GET['EntryID'];
    $tviewed = "UPDATE CMS_articles SET timesviewed=timesviewed+1 
		WHERE EntryID = '$EntryID'";
    mysql_query($tviewed);
    print "<center><table border='0' width=90% >";
    print "<tr><td valign='top' width='75%' align='center'><br><br>";
    print "<table border='1' width='90%' bordercolor=$borderc cellpadding='4' cellspacing='0'><tr><td bgcolor=$barcolor>";
    $article="SELECT * FROM CMS_articles where EntryID='$EntryID'";
    $article2=mysql_query($article) or die("It died");
    while($r=mysql_fetch_array($article2))
      {
         print "<b><font color=$barfont>$r[title] by $r[CMS_author] at $r[CMS_tsubmit]</font></b>";
         print "</td></tr>";
         print "<tr><td><p>$r[body]<br><br>";
         print "Rate article, 5 being the best";
         print "<form action='ratearticle.php' method='post'>";
         print "<input type='hidden' name='EntryID' value='$EntryID'>";
         print "<Select name='rankselect'>";
         print "<option>1</option>";
         print "<option>2</option>";
         print "<option>3</option>";
         print "<option>4</option>";
         print "<option>5</option>";
         print "</select><br>";
         print "<input type='submit' name='submit' value='Vote'></form><br><br>";
         print "<A href='index.php'>Back to Main</a>";
         print "</td></tr>";
     }
    print "</table></td>";
    print "<td valign='top' width='25%'><br><br>";
    print "<table border='1' cellpadding='4' cellspacing='0' bordercolor=$borderc>";
    print "<tr><td bgcolor=$barcolor><b><font color=$barfont>Highest rated Articles</b></font></td></tr>";
    print "<tr><td>";
    $rateselect="SELECT * from CMS_articles order by avgvotes DESC LIMIT 7";
    $rateselect2=mysql_query($rateselect) or die("it died");
    while($r=mysql_fetch_array($rateselect2))
      {
          $r[avgvotes] = number_format($r[avgvotes], 1, '.', '');
          print "<A href='index.php?EntryID=$r[EntryID]'>$r[title]</a>($r[avgvotes])<br>";
      }
    print "</td></tr></table><br><br>";
    print "<table border='1' cellpadding='4' cellspacing='0' bordercolor=$borderc>";
    print "<tr><td bgcolor=$barcolor><b><font color=$barfont>Most Read Articles</b></font></td></tr>";
    print "<tr><td>";
    $readselect="SELECT * from CMS_articles order by timesviewed DESC LIMIT 7";
    $readselect2=mysql_query($readselect) or die("it died");
    while ($r2=mysql_fetch_array($readselect2))
      {
         print "<A href='index.php?EntryID=$r2[EntryID]'>$r2[title]</a>($r2[timesviewed])<br>";
      }
    print "</td></tr></table><br><br>";
    print "<table border='1' cellpadding='4' cellspacing='0' bordercolor=$borderc>";
    print "<tr><td bgcolor=$barcolor><b><font color=$barfont>Search</b></font></td></tr>";
    print "<tr><td>";
    print "<form action='index.php?submit=1' method='post'>";
    print "<input type='text' name='searchterm' length='10'>";
    print "<input type='submit' name='submit' value='search'>";
    print "</form>";
    print "</td></tr></table></center>";
    
  
    print "</td></tr></table>";
  }
    

else if(isset($_POST['submit'])||isset($_POST['searchterm'])) //if user pressed search
{
 
  
    $numentries=$searchnumber;
    if(!isset($_GET['start'])) 
    {
      $start=0;
    }
    else
    {
      $start=$_GET['start'];
    }
    $searchterm=$_POST['searchterm'];
    print "<center><table border='0' width='90%'>";
    print "<tr><td valign='top' width='75%' align='center'><br><br>";
    $newselect="Select * FROM CMS_articles where title LIKE '%$searchterm%' OR shortdescription LIKE '%$searchterm%' OR body LIKE '%$searchterm%' order by EntryID DESC LIMIT $start, $numentries";

    $newsquery=mysql_query($newselect) or die("dies");
    while($news=mysql_fetch_array($newsquery))
      {
        print "<table border='1' bordercolor=$borderc cellpadding='4' cellspacing='0' width=90%>";
        print "<tr bgcolor=$barcolor><td><center><font color=$barfont size='2'>$news[title] at $news[CMS_tsubmit] by $news[CMS_author] </font></center></td></tr>";
        print "<tr><td>$news[shortdescription]<br><br><center><A href='index.php?EntryID=$news[EntryID]'>Click here to read more</a>";
        print "</td></tr></table><br><br>";
      }
    $order="SELECT * FROM CMS_articles where title LIKE '%$searchterm%' OR shortdescription LIKE '%$searchterm%' OR body LIKE '%$searchterm%'";
    $order2=mysql_query($order);
    $d=0;
    $f=0;
    $g=1;
    if(!isset($term))
    {
      $term=$look;
    }




   print "<font color='$fontcolor'>Page:</font> ";
   while($order3=mysql_fetch_array($order2))
   {
      if($f%$numentries==0)
   {
    
     $term=$searchterm;

      print "<A href='index.php?searchterm=$term&submit=1&start=$d'>$g</a> ";
      $g++;
    }
    $d=$d+1;
    $f++;

   }
     


    print "</td>";
    print "<td valign='top' width='25%'><br><br>";
    print "<table border='1' cellpadding='4' cellspacing='0' bordercolor=$borderc>";
    print "<tr><td bgcolor=$barcolor><b><font color=$barfont>Highest rated Articles</b></font></td></tr>";
    print "<tr><td>";
    $rateselect="SELECT * from CMS_articles order by avgvotes DESC LIMIT 7";
    $rateselect2=mysql_query($rateselect) or die("it died");
    while($r=mysql_fetch_array($rateselect2))
      {
          $r[avgvotes] = number_format($r[avgvotes], 1, '.', '');
          print "<A href='index.php?EntryID=$r[EntryID]'>$r[title]</a>($r[avgvotes])<br>";
      }
    print "</td></tr></table><br><br>";
    print "<table border='1' cellpadding='4' cellspacing='0' bordercolor=$borderc>";
    print "<tr><td bgcolor=$barcolor><b><font color=$barfont>Most Read Articles</b></font></td></tr>";
    print "<tr><td>";
    $readselect="SELECT * from CMS_articles order by timesviewed DESC LIMIT 7";
    $readselect2=mysql_query($readselect) or die("it died");
    while ($r2=mysql_fetch_array($readselect2))
      {
         print "<A href='index.php?EntryID=$r2[EntryID]'>$r2[title]</a>($r2[timesviewed])<br>";
      }
    print "</td></tr></table><br><br>";
    print "<table border='1' cellpadding='4' cellspacing='0' bordercolor=$borderc>";
    print "<tr><td bgcolor=$barcolor><b><font color=$barfont>Search</b></font></td></tr>";
    print "<tr><td>";
    print "<form action='index.php?submit=1' method='post'>";
    print "<input type='text' name='searchterm' length='10'>";
    print "<input type='submit' name='submit' value='search'>";
    print "</form>";
    print "</td></tr></table></center>";

    print "</td></tr></table>";
}  
 
else if(!isset($_POST['submit'])) //looking at root
  {

    $numentries=$entriesonpage;
    if(!isset($_GET['start'])) 
    {
      $start=0;
    }
    else
    {
      $start=$_GET['start'];
    }
    print "<center><table border='0' width='90%'>";
    print "<tr><td valign='top' width='75%' align='center'><br><br>";
    $newselect="Select * FROM CMS_articles order by EntryID DESC LIMIT $start,$numentries";
    $newsquery=mysql_query($newselect) or die("dies");
    while($news=mysql_fetch_array($newsquery))
      {
        print "<table border='1' bordercolor=$borderc cellpadding='4' cellspacing='0' width=90%>";
        print "<tr bgcolor=$barcolor><td><center><font color=$barfont size='2'>$news[title] at $news[CMS_tsubmit] by $news[CMS_author] </font></center></td></tr>";
        print "<tr><td>$news[shortdescription]<br><br><center><A href='index.php?EntryID=$news[EntryID]'>Click here to read more</a>";
        print "</td></tr></table><br><br>";
      }




$order="SELECT * from CMS_articles";
$order2=mysql_query($order);
$d=0;
$f=0;
$g=1;




print "<font color='#$fontcolor'>Page:</font> ";
while($order3=mysql_fetch_array($order2))
{
if($f%$numentries==0)
  {
    

    print "<A href='index.php?start=$d'>$g</a> ";
    $g++;
  }
$d=$d+1;
$f++;

}



    print "</td>";
    print "<td valign='top' width='25%'><br><br>";
    print "<table border='1' cellpadding='4' cellspacing='0' bordercolor=$borderc>";
    print "<tr><td bgcolor=$barcolor><b><font color=$barfont>Highest rated Articles</b></font></td></tr>";
    print "<tr><td>";
    $rateselect="SELECT * from CMS_articles order by avgvotes DESC LIMIT 7";
    $rateselect2=mysql_query($rateselect) or die("it died");
    while($r=mysql_fetch_array($rateselect2))
      {
          $r[avgvotes] = number_format($r[avgvotes], 1, '.', '');
          print "<A href='index.php?EntryID=$r[EntryID]'>$r[title]</a>($r[avgvotes])<br>";
      }
    print "</td></tr></table><br><br>";
    print "<table border='1' cellpadding='4' cellspacing='0' bordercolor=$borderc>";
    print "<tr><td bgcolor=$barcolor><b><font color=$barfont>Most Read Articles</b></font></td></tr>";
    print "<tr><td>";
    $readselect="SELECT * from CMS_articles order by timesviewed DESC LIMIT 7";
    $readselect2=mysql_query($readselect) or die("it died");
    while ($r2=mysql_fetch_array($readselect2))
      {
         print "<A href='index.php?EntryID=$r2[EntryID]'>$r2[title]</a>($r2[timesviewed])<br>";
      }
    print "</td></tr></table><br><br>";
    print "<table border='1' cellpadding='4' cellspacing='0' bordercolor=$borderc>";
    print "<tr><td bgcolor=$barcolor><b><font color=$barfont>Search</b></font></td></tr>";
    print "<tr><td>";
    print "<form action='index.php?submit=1' method='post'>";
    print "<input type='text' name='searchterm' length='10'>";
    print "<input type='submit' name='submit' value='search'>";
    print "</form>";
    print "</td></tr></table></center>";
    
    print "</td></tr></table>";
   }
    
  ?>