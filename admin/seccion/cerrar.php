<?php 
session_start();
// va a destruir todas las variables y sesiones
session_destroy();
header('Location:../index.php');?>