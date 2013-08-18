<?php
    require_once 'core/Struct.php';
    require_once 'core/Generator.php';

    $struct=new Struct(
        "core",
        "",
        "Environment",
        array(
            array("name"=>"name",       "type"=>"string",   "comment"=>"Nombre del Environment"),
            array("name"=>"urls",       "type"=>"array",    "comment"=>"Lista de las urls para las que el ambiente es válido"),
            array("name"=>"database",   "type"=>"Database", "comment"=>"Base de datos del Environment")
        ),
        "name",
        ""
    );
    
    $generator=new Generator("maqinato","maparrar <maparrar@gmail.com>","https://github.com/maparrar/maqinato",array($struct),"Object");
    $generator->createFiles();
    
    echo '<a href="index.php">Volver</a>';