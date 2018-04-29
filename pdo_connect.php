<?php
       $db_host = "localhost";
       $db_user = "root";
       $db_pass = "GGYY";
       $db_select = "mydb";       
       $dbconnect = "mysql:host=".$db_host.";dbname=".$db_select.";charset=utf8";
       //建立使用PDO方式連線的物件，並放入指定的相關資料
       $dbgo = new PDO($dbconnect, $db_user, $db_pass);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

