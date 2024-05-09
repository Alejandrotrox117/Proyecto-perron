<?php

require_once('../model/Database.php');

function handlerUserData($username)
{
    $query = "SELECT * FROM `usuario` WHERE `usuario` ='" . $username . "'";

    $send = $this->database->handleQuery($query);

    if ($send->num_rows > 0) {
        while ($row = $send->fetch_assoc()) {
            return $row;
        }
    } else {
        return 0;
    }
}

function handlerAllUsersData()
{
    $query = "SELECT * FROM `usuario`";

    $send = $this->database->handleQuery($query);

    $users = array();

    if (mysqli_num_rows($send) > 0) {
        while ($rows =  mysqli_fetch_assoc($send)) {
            array_push($users, $rows);
        }
        return $users;
    } else {
        return 0;
    }
}

function handlerUserIdRolByUsername($username)
{
    $query = "SELECT `rolId` FROM `usuario` WHERE `username` ='" . $username . "'";

    $send = $this->database->handleQuery($query);

    if ($send->num_rows > 0) {
        while ($row = $send->fetch_assoc()) {
            return $row['id_rol'];
        }
    } else {
        return 0;
    }
}

function getUserPassword($username)
{
    $query = "SELECT `contrasena` FROM `usuario` WHERE `username` ='" . $username . "'";

    $send = $this->database->handleQuery($query);

    if ($send->num_rows > 0) {
        while ($row = $send->fetch_assoc()) {
            return $row['contrasena'];
        }
    } else {
        return 0;
    }
}

function handlerUserRol($rolId)
{
    $query = "SELECT `nombre` FROM `rol` WHERE `rolId` ='" . $rolId . "'";

    $send = $this->database->handleQuery($query);

    if ($send->num_rows > 0) {
        while ($row = $send->fetch_assoc()) {
            return $row['nombre'];
        }
    } else {
        return 0;
    }
}

