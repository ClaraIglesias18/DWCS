<?php
if(isset($_GET['nombre'])) {
    echo "mi nombre es: ".$_GET['nombre'];
}
echo"<pre>";
var_dump($_GET);
echo "</pre>"

?>