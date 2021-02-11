<?php
   $host = "soptravinet.ipagemysql.com"; //hostname
   $username="soptravidb2"; //username
   $password="patito01"; //database pw
   $db_name="soptravidb2";  //database name
   
   //connect to database
   mysql_connect("$host","$username","$password") or die("Cannot Connect to Server");
   mysql_select_db("$db_name") or die("Cannot Select DB");
  mysql_query("SET CHARACTER SET utf8 ");   
   
?> 

