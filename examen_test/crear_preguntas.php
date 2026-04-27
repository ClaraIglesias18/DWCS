<?php
session_start();
require_once 'db.php';
require_once 'funciones_preguntas.php';

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: login.php");
    exit();
}

