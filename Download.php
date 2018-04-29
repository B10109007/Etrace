<?php

session_start();
$No = filter_input(INPUT_GET, "No");
$filename = filter_input(INPUT_GET, "filename");
try {
    include 'pdo_connect.php';
    $sql = "SELECT * FROM file WHERE FileNo =?";
    $sth = $dbgo->prepare("$sql");
    $sth->bindValue(1, $No, PDO::PARAM_INT);
    if ($sth->execute()) {
        $filerow = $sth->fetch();
    }
    $sth = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$dbgo = null;
if ($filename == $filerow['FileName']) {
    $fileurl = $filerow['FileUrl'];
    $filetype = $filerow['FileType'];
    $filename = $filerow['FileName'];
//header('Content-Type:'. $filetype);
//header('Content-Disposition: attachment; filename="'.$filename.'"');
//readfile($fileurl);
    $download_rate = 300; // set the download rate limit (=> 20,5 kb/s)
    $fileurl=iconv('UTF-8','BIG5',$fileurl);
    if (file_exists($fileurl) && is_file($fileurl)) {
        header('Cache-control: private');
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($fileurl));
        header('Content-Disposition: filename=' . $filename);

        flush();
        $file = fopen($fileurl, "r");
        while (!feof($file)) {
            // send the current file part to the browser
            print fread($file, round($download_rate * 1024));
            // flush the content to the browser
            flush();
            // sleep one second
            sleep(1);
        }
        fclose($file);
    } else {
        die('Error: The file ' . $fileurl . ' does not exist!');
    }
}



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

