<?php

require_once 'datos.php';
session_start();

function getRegistros(){
    $artistasSql = "SELECT * FROM ARTISTAS";
    return ArtistasModel::getRegistros($artistasSql);
}

function setearFiltros(){

}

function agregaRegistro($artista, $nombre, $cancion, $album, $nacionalidad, $nacimiento)
{
    $sqlInsert = "INSERT INTO ARTISTAS (ARTISTA, NOMBRE, CANCION, ALBUM, NACIONALIDAD, NACIMIENTO)
    values ('%s', '%s', '%s' , '%s', '%s', '%s');";

    $sqlInsert = sprintf(
        $sqlInsert,
        $artista, 
        $nombre, 
        $cancion, 
        $album, 
        $nacionalidad, 
        $nacimiento
    );
    return ArtistasModel::executeNonQuery($sqlInsert);

}

function actualizarRegistro(
    $ID,
    $artista, 
    $nombre, 
    $cancion, 
    $album, 
    $nacionalidad, 
    $nacimiento
) {
    $sqlUpdate = "UPDATE ARTISTAS set  ARTISTA = '%s',
        NOMBRE = '%s', CANCION = '%s', ALBUM = '%s', NACIONALIDAD = '%s', NACIMIENTO = '%s'
        where ID = '%s';"
    ;
    $sqlUpdate = sprintf(
        $sqlInsert,
        $artista, 
        $nombre, 
        $cancion, 
        $album, 
        $nacionalidad, 
        $nacimiento,
    );

    return ArtistasModel::executeNonQuery($sqlUpdate);

}

function obtenerRegistro($ID)
{
    $sqlSelect = "SELECT * FROM ARTISTAS where ID ='%s';";
    return ArtistasModel::getRegistro(
        sprintf(
            $sqlSelect,
            $ID
        )
    );
}

function eliminarRegistro($ID) 
{
    $sqlDelete = "DELETE FROM ARTISTAS where ID='%s';";
    return ArtistasModel::executeNonQuery(
        sprintf(
            $sqlstr,
            $ID
        )
    );
}

function incializarTabla() {
    $sqlCreate = "CREATE TABLE IF NOT EXISTS ARTISTAS (
    'ID' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    'ARTISTA' TEXT NOT NULL ,
    'NOMBRE' TEXT NOT NULL,
    'CANCION' TEXT NOT NULL,
    'ALBUM' TEXT NOT NULL,
    'NACIONALIDAD' TEXT NOT NULL,
    'NACIMIENTO' TEXT NOT NULL
    );";

    ArtistasModel::executeNonQuery($sqlCreate);
}

function irALista()
{
    header("location:listview.php");
    die();
}

function irAListaConMensaje($mensaje, $to)
{
    echo '<script>alert("'.$mensaje.'");window.location.assign("'.$to.'")</script>';
    die();
}
?>
