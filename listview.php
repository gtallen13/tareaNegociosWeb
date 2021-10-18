<?php
require_once 'businesslogic.php';
$txtArtista = "";
$txtNombre = "";
$txtNacionalidad = "";

$artistas = getRegistros();
$filtro = array();
//Filtro 
if (isset($_POST['btnFiltrar'])){
    $txtArtista = $_POST['txtArtista'];
    $txtNombre = $_POST['txtNombre'];
    $txtNacionalidad = $_POST['txtNacionalidad'];
    $filtro = setearFiltros($txtArtista, $txtNombre, $txtNacionalidad);
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
            <form action="listview.php" method="post">
                <label for="txtArtista">Artista</label><input type="text" name="txtArtista" id="txtArtista" value="<?php echo $txtArtista; ?>" placeholder="Polache" /> <br />
                <label for="txtNombre">Nombre</label><input type="text" name="txtNombre" id="txtNombre" value="<?php echo $txtNombre; ?>" placeholder="Juan Gonzales" /> <br />
                <label for="txtNacionalidad">Nacionalidad</label><input type="text" name="txtNacionalidad" id="txtNacionalidad" value="<?php echo $txtNacionalidad; ?>" placeholder="Hondureño" /> <br />
                <button type = "submit" name="btnFiltrar">Filtrar</button>
            </form>
        </section>
        <!-- Filtro -->
        <section>
            <?php if ($filtro){?>
                <h2>Artista Filtrado</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Artista</th>
                            <th>Nombre Real</th>
                            <th>Cancion mas Popular</th>
                            <th>Album Debut</th>
                            <th>Nacionalidad</th>
                            <th>Nacimiento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $filtro['ID']?></td>
                            <td><?php echo $filtro['ARTISTA']?></td>
                            <td><?php echo $filtro['NOMBRE']?></td>
                            <td><?php echo $filtro['CANCION']?></td>
                            <td><?php echo $filtro['ALBUM']?></td>
                            <td><?php echo $filtro['NACIONALIDAD']?></td>
                            <td><?php echo $filtro['NACIMIENTO']?></td>

                            <td>
                                <a href="formview.php?ID=<?php echo $filtro["ID"]; ?>&mode=UPD">Editar</a>&nbsp;
                                <a href="formview.php?ID=<?php echo $filtro["ID"]; ?>&mode=DSP">Consultar</a>&nbsp;
                                <a href="formview.php?ID=<?php echo $filtro["ID"]; ?>&mode=DEL">Eliminar</a>  
                            </td>
                        </tr>
                    </tbody>
                </table>
               <?php } else echo "<h2></h2>";?>

        </section>

        <!-- Artistas -->
        <section>
            <h2>Artistas</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Artista</th>
                        <th>Nombre Real</th>
                        <th>Cancion mas Popular</th>
                        <th>Album Debut</th>
                        <th>Nacionalidad</th>
                        <th>Nacimiento</th>
                        <th><a href="formview.php?ID=na&mode=INS">Registrar</a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($artistas as $row) { ?>
                        <tr>
                            <td><?php echo $row["ID"]; ?></td>
                            <td><?php echo $row["ARTISTA"]; ?></td>
                            <td><?php echo $row["NOMBRE"]; ?></td>
                            <td><?php echo $row["CANCION"]; ?></td>
                            <td><?php echo $row["ALBUM"]; ?></td>
                            <td><?php echo $row["NACIONALIDAD"]; ?></td>
                            <td><?php echo $row["NACIMIENTO"]; ?></td>
                            <td>
                                <a href="formview.php?ID=<?php echo $row["ID"]; ?>&mode=UPD">Editar</a>&nbsp;
                                <a href="formview.php?ID=<?php echo $row["ID"]; ?>&mode=DSP">Consultar</a>&nbsp;
                                <a href="formview.php?ID=<?php echo $row["ID"]; ?>&mode=DEL">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfooter></tfooter>
            </table>
            <section>

    </main>
    <footer>

    </footer>
</body>

</html>
