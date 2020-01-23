<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
       <style type="text/css">
           
           .embed-container {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
    }
    .embed-container iframe {
        position: absolute;
        top:0;
        left: 0;
        width: 100%;
        height: 100%;
}
       </style>
    </head>
    <body>
       
        <center>
        <?php
        include 'config.inc.php';
        $db=new Conect_MySql();
            $sql = "select*from tbl_documentos where id_documento=".$_GET['id'];
            $query = $db->execute($sql);
            if($datos=$db->fetch_row($query)){
                if($datos['nombre_archivo']==""){?>
        <p>NO tiene archivos</p>
                <?php }else{ ?>
                    <div class="embed-container">
        <iframe width="560" height="315" src="archivos/<?php echo $datos['nombre_archivo']; ?>">hola</iframe>
                </div>
                <?php } } ?>
                </center>
    </body>
</html>
