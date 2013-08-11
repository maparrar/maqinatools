$package="core";
    $subpackage="routing";
    $class="Request";
    $attributes=array(
        array("name"=>"uri", "type"=>"string",   "comment"=>"URI del request"),
        array("name"=>"controller", "type"=>"string",   "comment"=>"Controlador del request"),
        array("name"=>"function", "type"=>"string",   "comment"=>"Función del request"),
        array("name"=>"parameters", "type"=>"array",   "comment"=>"Parámetros pasados al request")
    );