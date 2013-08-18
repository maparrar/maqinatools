"core",
        "",
        "Database",
        array(
            array("name"=>"name", "type"=>"string",   "comment"=>"Nombre de la base de datos"),
            array("name"=>"driver", "type"=>"string",   "comment"=>"Tipo de conexión: mysql, oracle, ..."),
            array("name"=>"persistent", "type"=>"bool",   "comment"=>"Si es una base de datos persistente"),
            array("name"=>"host", "type"=>"string",   "comment"=>"Host donde está alojada la base de datos"),
            array("name"=>"connections", "type"=>"Connection[]",   "comment"=>"Array de conexiones a la base de datos: read, write, delete, all")
        ),
        "name",
        ""