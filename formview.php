<?php
require_once 'businesslogic.php';

$txtArtista = "";
$txtNombre = "";
$txtCancion = "";
$txtAlbum = "";
$txtNacionalidad = "";
$txtNacimiento = "";
$txtAlbum = "";
$txtNacionalidad = "";

$actionText = "Confirmar";
$titleText = "Nuevo Alumno";
$mode = "NAP";
$readonly = "";
$modeDesc = array(
    "INS" => "Nuevo Alumno",
    "DSP" => "Detalle de %s %s",
    "UPD" => "Editando %s %s",
    "DEL" => "Eliminando %s %s"
);

// Get
if (isset($_GET["cuenta"])) {
    if ($_GET["cuenta"] != "na") {
        $txtCuenta = $_GET["cuenta"];
    }
    $mode = $_GET["mode"];
}
// Post
if (isset($_POST["btnPrimario"])) {
    $mode = $_POST["mode"];
    $txtID = $_POST["txtID"]
    $txtArtista = $_POST["txtArtista"];
    $txtNombre = $_POST["txtNombre"];
    $txtCancion = $_POST["txtCancion"];
    $txtAlbum = $_POST["txtAlbum"];
    $txtNacionalidad = $_POST["txtNacionalidad"];
    // Validaciones

    //Determinar que accion tomar
    switch ($mode) {
        case "INS":
            if (agregaRegistro($txtArtista, $txtNombre, $txtCancion, $txtAlbum, $txtNacionalidad, $txtNacimiento)) {
                irAListaConMensaje("Registro agregado Satisfactoriamente.", "listview.php");
            }
            break;
        case "UPD":
            if (actualizarRegistro($txtArtista, $txtNombre, $txtCancion, $txtAlbum, $txtNacionalidad, $txtNacimiento)) {
                irAListaConMensaje("Registro actualizado Satisfactoriamente.", "listview.php");
            }
            break;
        case "DEL";
            if (eliminarRegistro($txtCuenta)) {
                irAListaConMensaje("Registro eliminado Satisfactoriamente.", "listview.php");
            }
            break;
    }
}
// Any Code
if (isset($modeDesc[$mode])) {
    if ($mode != "INS") {
        // Sacar de la DB el valor de la cuenta
        $tmpAlumno = obtenerRegistro($txtCuenta);
        if (count($tmpAlumno) == 0) {
            irALista();
        }
        $txtNombre = $tmpAlumno["NOMBRE"];
        $txtCancion = $tmpAlumno["CARRERA"];
        $txtAlbum = $tmpAlumno["CAMPUS"];
        $txtNacionalidad = $tmpAlumno["BECAS"];
        $titleText = sprintf($modeDesc[$mode], $txtCuenta, $txtNombre);

        if ($mode == 'DSP' || $mode == 'DEL') {
            $readonly = "readonly disabled";
        }
    }

} else {
    irALista();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajar con Alumnos</title>
</head>

<body>
    <header>
        <h1>Trabajar con Alumnos</h1>
    </header>
    <main>
        <section>

        </section>
        <section>
            <h2><?php echo $titleText; ?></h2>
            <form action="formview.php" method="post">
                <input type="hidden" name="mode" id="mode" value="<?php echo $mode; ?>" />
                <label for="txtID">ID</label>
                <?php if ($mode !== "INS") {
                ?>
                    <input type="hidden" name="txtCuenta" id="txtCuenta" value="<?php echo $txtCuenta; ?>" placeholder="Cuenta" />
                    <span><?php echo $txtCuenta; ?></span>
                    <br />
                <?php
                } else {
                ?>
                    <input type="text" name="txtCuenta" id="txtCuenta" value="<?php echo $txtCuenta; ?>" placeholder="Cuenta" /> <br />
                <?php
                }
                ?>
                <label for="txtArtista">Artista</label><input <?php echo $readonly; ?> type="text" name="txtArtista" id="txtArtista" value="<?php echo $txtArtista; ?>" placeholder="Nombre" /> <br />
                <label for="txtNombre">Nombre</label><input <?php echo $readonly; ?> type="text" name="txtNombre" id="txtNombre" value="<?php echo $txtNombre; ?>" placeholder="Nombre" /> <br />
                <label for="txtCancion">Carrera</label><input <?php echo $readonly; ?> type="text" name="txtCancion" id="txtCancion" value="<?php echo $txtCancion; ?>" placeholder="Carrera" /> <br />
                <label for="txtAlbum">Campus</label><input <?php echo $readonly; ?> type="text" name="txtAlbum" id="txtAlbum" value="<?php echo $txtAlbum; ?>" placeholder="Campus" /> <br />
                <label for="txtNacionalidad">Becas</label><input <?php echo $readonly; ?> type="text" name="txtNacionalidad" id="txtNacionalidad" value="<?php echo $txtNacionalidad; ?>" placeholder="Becas" /> <br />
                <label for="txtNacimiento">Becas</label><input <?php echo $readonly; ?> type="text" name="txtNacimiento" id="txtNacimiento" value="<?php echo $txtNacimiento; ?>" placeholder="Becas" /> <br />
                <?php
                if ($mode != 'DSP') {
                ?>
                    <button name="btnPrimario" type="submit"><?php echo $actionText; ?></button>
                <?php } ?>
                <button name="btnSecundario" id="btnSecundario">Cancelar</button>
            </form>
        </section>

    </main>
    <footer>

    </footer>
    <script>
        document.addEventListener("DOMContentLoaded", function(e){
            var btnSecundario = document.getElementById("btnSecundario");
            btnSecundario.addEventListener("click", function(e){
                e.preventDefault();
                e.stopPropagation();
                window.location.assign("listview.php");
            });
        });
    </script>
</body>

</html>
