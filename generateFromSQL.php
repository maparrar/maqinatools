<?php
    require_once 'core/Struct.php';
    require_once 'core/Generator.php';
    

    $generator=new Generator("maqinato","maparrar <maparrar@gmail.com>","https://github.com/maparrar/maqinato");
    $generator->readFromSQL($sql);
    $generator->createFiles();