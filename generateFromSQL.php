<?php
    require_once 'core/Struct.php';
    require_once 'core/Generator.php';
    
    echo "File: ".$_GET["file"]."<br/><br/>";
    
    $filename = "data/".$_GET["file"];
    $handle = fopen($filename, "r");
    $sql = fread($handle, filesize($filename));
    fclose($handle);
    
    $generator=new Generator("maqinato","maparrar <maparrar@gmail.com>","https://github.com/maparrar/maqinato");
    $generator->readFromSQL($sql);
    $generator->createFiles();