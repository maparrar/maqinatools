"html5sync",
        "core",
        "Table",
        array(
            array("name"=>"id", "type"=>"int",   "comment"=>"Identificador de la tabla"),
            array("name"=>"name", "type"=>"string",   "comment"=>"Nombre de la tabla"),
            array("name"=>"mode", "type"=>"string",   "comment"=>"Modo de uso de la tabla: ('unlock': Para operaciones insert+read), ('lock': Para operaciones update+delete)"),
            array("name"=>"fields", "type"=>"array",   "comment"=>"Array con los nombres de las columnas"),
            array("name"=>"data", "type"=>"array",   "comment"=>"Array con los datos de la tabla"),
            array("name"=>"pk", "type"=>"string",   "comment"=>"Nombre de la Primary Key para la tabla")
        ),
        "id",
        ""