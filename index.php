<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <hr>
            <h3>Generar una clase a partir de una estructura</h3>
            <p>Escriba la estructura de la clase en generator.php. Luego haga click en el siguiente enlace:</p>
            <a href="generateOne.php">Generar una clase</a>
        <hr>
            <h3>Generar un conjunto de clases a partir de un script de SQL</h3>
            <p>Seleccione el script y luego haga click en enviar:</p>
            <form action="upload_script.php" method="post" enctype="multipart/form-data">
                <label for="file">Script:</label>
                <input type="file" name="file" id="file"><br>
                <input type="submit" name="submit" value="Enviar">
            </form>
        <hr>
    </body>
</html>