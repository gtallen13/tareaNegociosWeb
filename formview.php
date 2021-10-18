<?php
require_once 'businesslogic.php';
$txtID = "";
$txtArtista = "";
$txtNombre = "";
$txtCancion = "";
$txtAlbum = "";
$txtNacionalidad = "";
$txtNacimiento = "";
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
if (isset($_GET["ID"])) {
    if ($_GET["ID"] != "na") {
        $txtID = $_GET["ID"];
    }
    $mode = $_GET["mode"];
}
// Post
if (isset($_POST["btnPrimario"])) {
    $mode = $_POST["mode"];
    $txtID = $_POST["txtID"];
    $txtArtista = $_POST["txtArtista"];
    $txtNombre = $_POST["txtNombre"];
    $txtCancion = $_POST["txtCancion"];
    $txtAlbum = $_POST["txtAlbum"];
    $txtNacionalidad = $_POST["txtNacionalidad"];
    $txtNacimiento = $_POST["txtNacimiento"];
    // Validaciones

    //Determinar que accion tomar
    switch ($mode) {
        case "INS":
            if (agregaRegistro($txtArtista, $txtNombre, $txtCancion, $txtAlbum, $txtNacionalidad, $txtNacimiento)) {
                irAListaConMensaje("Registro agregado Satisfactoriamente.", "listview.php");
            }
            break;
        case "UPD":
            if (actualizarRegistro($txtID,$txtArtista, $txtNombre, $txtCancion, $txtAlbum, $txtNacionalidad, $txtNacimiento)) {
                irAListaConMensaje("Registro actualizado Satisfactoriamente.", "listview.php");
            }
            break;
        case "DEL";
            if (eliminarRegistro($txtID)) {
                irAListaConMensaje("Registro eliminado Satisfactoriamente.", "listview.php");
            }
            break;
    }
}
// Any Code
if (isset($modeDesc[$mode])) {
    if ($mode != "INS") {
        // Sacar de la DB el valor de la cuenta
        $tmpAlumno = obtenerRegistro($txtID);
        if (count($tmpAlumno) == 0) {
            irALista();
        }
        $txtArtista = $tmpAlumno["ARTISTA"];
        $txtNombre = $tmpAlumno["NOMBRE"];
        $txtCancion = $tmpAlumno["CANCION"];
        $txtAlbum = $tmpAlumno["ALBUM"];
        $txtNacionalidad = $tmpAlumno["NACIONALIDAD"];
        $txtNacimiento = $tmpAlumno["NACIMIENTO"];
        $titleText = sprintf($modeDesc[$mode], $txtID, $txtArtista);

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
    <title>Artistas</title>
</head>

<body>
    <header>
        <h1>Artistas</h1>
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
                    <input type="hidden" name="txtID" id="txtID" value="<?php echo $txtID; ?>" placeholder="Cuenta" />
                    <span><?php echo $txtID; ?></span>
                    <br />
                <?php
                } ?>
                <label for="txtArtista">Artista</label><input required <?php echo $readonly; ?> type="text" name="txtArtista" id="txtArtista" value="<?php echo $txtArtista; ?>" placeholder="Polache" /> <br />
                <label for="txtNombre">Nombre</label><input required <?php echo $readonly; ?> type="text" name="txtNombre" id="txtNombre" value="<?php echo $txtNombre; ?>" placeholder="Juan Fernandez" /> <br />
                <label for="txtCancion">Cancion</label><input required <?php echo $readonly; ?> type="text" name="txtCancion" id="txtCancion" value="<?php echo $txtCancion; ?>" placeholder="Pedazo de Mujer" /> <br />
                <label for="txtAlbum">Album</label><input required <?php echo $readonly; ?> type="text" name="txtAlbum" id="txtAlbum" value="<?php echo $txtAlbum; ?>" placeholder="Pan sin sal" /> <br />
                <label for="txtNacionalidad">Nacionalidad</label><input required <?php echo $readonly; ?> type="text" name="txtNacionalidad" id="txtNacionalidad" value="<?php echo $txtNacionalidad; ?>" placeholder="Hondureño" /> <br />
                <label for="txtNacimiento">Nacimiento</label><input required <?php echo $readonly; ?> type="date" name="txtNacimiento" id="txtNacimiento" value="<?php echo $txtNacimiento; ?>" placeholder="1990-09-12" /> <br />
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
