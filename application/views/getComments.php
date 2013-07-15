<?php  
$con=mysql_connect("localhost","maventri_lalbook",")uA4DQS#o(L6") or die("error in connection".mysql_error());
mysql_select_db("maventri_lalbooks",$con);
$req_id=$_POST['hidden_userid'];
echo $req_id;
        $query = mysql_query("SELECT * FROM reviews where userid=$req_id")or die("error in ".mysql_error());
        print 'Your\'s Comments:';        
        while ($row = mysql_fetch_array($query)) {  
            /*print '<div id="news_'.$row[\'id\'].'">'.$row[\'comments\'].'</div>';  
            print '<span class="toggle" id="'.$row[\'id\'].'">get comments for this article: '.$row['rating'].'</a></span>';  
            print '<div id="comments_'.$row[\'id\'].'" class="comments"></div> */ 
			print '<div id="comments">'.$row['comments'].'</div>';
			print '<div id="news">'.$row['rating'].'</div>';
        }  
?>  