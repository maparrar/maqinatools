<?php
    require_once 'core/Struct.php';
    require_once 'core/Generator.php';

    $struct=new Struct(
        "models",
        "basic",
        "User",
        array(
            array("name"=>"code",    "type"=>"int",   "comment"=>"Código de usuario"),
            array("name"=>"name",    "type"=>"string","comment"=>"Nombre de usuario"),
            array("name"=>"lastname","type"=>"string","comment"=>"Apellido de usuario")
        ),
        "code",
        "Object"
    );
    
    $generator=new Generator("maqinato","maparrar <maparrar@gmail.com>","https://github.com/maparrar/maqinato",array($struct),"Object");
    $generator->createFiles();
    
    echo '<a href="index.php">Volver</a>';