<?php
function connectdb()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "duanmau1";

    try {
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=" . $database, $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function getOne($sql)
{
    $conn = connectdb();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function getAll($sql)
{
    $conn = connectdb();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function querySql($sql)
{
    $conn = connectdb();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
