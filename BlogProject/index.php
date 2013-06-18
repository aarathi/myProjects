<?php 

 // Connects to your Database 

//include 'dbConnect.php';

$con=mysql_connect("localhost","root","root");
if(!$con)
die('could not connect'.mysqlerror());
else
mysql_select_db("qb_blog",$con);

 //This checks to see if there is a page number. If not, it will set it to page 1 

 if (!(isset($pagenum))) 
 { 
    $pagenum = 1;
 } 

 //Here we count the number of results 

 $data = mysql_query("SELECT * FROM Post") or die(mysql_error()); 

 $rows = mysql_num_rows($data); 

 //This is the number of results displayed per page 

 $page_rows = 2; 

 //This tells us the page number of our last page 

 $last = ceil($rows/$page_rows); 

 //this makes sure the page number isn't below one, or more than our maximum pages 

 if ($pagenum < 1) 
 { 
    $pagenum = 1; 
 } 

 elseif ($pagenum > $last) 
 { 
    $pagenum = $last; 
 } 

 //This sets the range to display in our query 

 $max = 'limit ' .($pagenum -1) * $page_rows .',' .$page_rows; 

//This is your query again, the same one... the only difference is we add $max into it

 $data_p = mysql_query("SELECT * FROM Post p join User u on p.user_id=u.user_id join Category c on p.category_id=c.category_id $max") or die(mysql_error()); 

 ?> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Clean Blog Template</title>
<meta name="keywords" content="clean blog template, html css layout" />
<meta name="description" content="Clean Blog Template is provided by templatemo.com" />
<link href="Style.css" rel="stylesheet" type="text/css" />
<script src="jquery_1.9.1.js"></script>
<script src="script.js"></script>
</head>
<body>

<div id="wrapper">

	<div id="menu">
                
        <ul>
            <li><a href="postAdd.php" class="current">Post</a></li>
            <li><label id="login"><a href="#" class="current">Login</a></label></li>
        </ul>	
    
    </div> <!-- end of menu -->

    <div id="left_column">
    
        <div id="header">
        
            <div id="site_title">
                <h1><a href="index.php" target="_parent">Clean <strong>Blog</strong></a></h1>
            </div><!-- end of site_title -->
            
        </div> <!-- end of header -->  
        
        <div id="sidebar">
    	
            <h4>Categories</h4>
            <ul class="category_list">
                <li><a href="http://www.templatemo.com/page/1" target="_parent">Sports</a></li>
                <li><a href="http://www.templatemo.com/page/2" target="_parent">Arts & Entertainment</a></li>
                <li><a href="http://www.templatemo.com/page/3" target="_parent">Education & Communications</a></li>
                <li><a href="http://www.templatemo.com/page/4" target="_parent">Health</a></li>
                <li><a href="http://www.templatemo.com/page/4" target="_parent">IT</a></li>
            </ul>     
            
        </div> <!-- end of sidebar --> 
    
    </div> <!-- end of left_column -->
    
    <div id="right_column">
        
<!--        <div id="templatemo_main">-->
        <?php 
//        include_once 'Scripts/dbConnect.php';
//        $db_host = "localhost";  
//        $db_username = "root";  
//        $db_pass = "root";  
//        $db_name = "qb_blog";  
//        $con=mysql_connect("localhost","root","root") or die ("Error: Could not connect to mysql");
//        mysql_select_db("qb_blog",$con) or die ("Database does not exist");

//        $query="SELECT * FROM Post p join User u on p.user_id=u.user_id join Category c on p.category_id=c.category_id ";
//        $sql1 = mysql_query($query,$con);

        ?>
        <!--</div>-->
        <div id="right_column">
                    
           <div class="post_section">
               <!--This is where you display your query results-->
                <?php while($row = mysql_fetch_array( $data_p )) 
                        { 
                            $title=$row['post_title'];
                            $author=$row['user_firstname'];
                            $postDate=$row['post_date'];
                            $category=$row['category_name'];
                            $content=substr($row['post_body'],0,250);
                ?>              
                <h2><a href="blog_post.html"><?php echo $title ?></a></h2>
                <?php echo $postDate ?> | 
                <strong>Author: <?php echo $author ?></strong>  | 
                <strong>Category: </strong> <a href="#"><?php echo $category ?></a>
                <br> <br> 
                <p> <?php echo $content."...."; ?></p>
                <a href="blog_post.html">Read more..</a> <br> <br> <br>
                <?php } ?>
            </div> 
      </div>
    
  <div class="cleaner"></div>
  </div> 
    
<div class="pagination">
    <?php
        echo " Page $pagenum of $last <p>";
        if($pagenum==1)
        {
            
        }
        else
        {
            echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=1'> <<-First</a> ";
            echo "";
            $previous = $pagenum - 1;
            echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$previous'>  <- Previous </a>";
        }
        
        echo " ---- ";
        
        if($pagenum==$last)
        {
            
        }
        else
        {
            $next=$pagenum+1;
            echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$next'> Next -></a>";
            echo "";
            echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$last'> Last ->></a>";
        }
    ?>
</div> <!--end of pagination-->

    <div id="footer">
        
    </div>    
</div> <!-- end of wrapper -->

<div id="loginForm">
    <form action="login.php" method="post">
    <label>Email:</label> <input id="email" type="text" name="email"><br><br>
    <label>Password:</label> <input id="password" type="password" name="password">
    <input id="loginButton" type="button" name="loginButton">
</div>

</body>
</html>

