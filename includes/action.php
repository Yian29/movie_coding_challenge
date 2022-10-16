<?php

    require_once 'function.php';
    $movie = new Movie();
    $valid = array('success' => false, 'messages' => array());

    // ADD MOVIE
    if ($_SERVER['REQUEST_METHOD'] === "POST" && $_GET['action'] === "add") {
        
        $id = uniqid();
        $name = $_POST['name'];
        $genre = $_POST['genre'];

        if($movie->requiredInput($name) !== false || $movie->requiredInput($genre) !== false){
            $valid['success'] = false;
            $valid['messages'] = "All fields cannot be empty";
            echo json_encode($valid);
            exit();
        }

        if($movie->exist($id, "id") !== false){
            $valid['success'] = false;
            $valid['messages'] = "Movie ID already exist";
            echo json_encode($valid);
            exit();
        }

        if($movie->exist($name, "name") !== false){
            $valid['success'] = false;
            $valid['messages'] = "Movie name already exist";
            echo json_encode($valid);
            exit();
        }

        $movie->create($id, $name, $genre);
        
    }

    // FETCH MOVIE
    if ($_SERVER['REQUEST_METHOD'] === "GET" && $_GET['action'] === "fetch") {

        $movie->fetch();

    }

    // UPDATE MOVIE
    if ($_SERVER['REQUEST_METHOD'] === "POST" && $_GET['action'] === "update") {
        
        $id = $_POST['id'];
        $name = $_POST['name'];
        $genre = $_POST['genre'];

        if($movie->requiredInput($id) !== false || $movie->requiredInput($name) !== false || $movie->requiredInput($genre) !== false){
            $valid['success'] = false;
            $valid['messages'] = "All fields cannot be empty";
            echo json_encode($valid);
            exit();
        }

        if($movie->exist($id, "id") !== true){
            $valid['success'] = false;
            $valid['messages'] = "Movie ID not found.";
            echo json_encode($valid);
            exit();
        }

        if($movie->existInUpdate($id, $name) !== false){
            $valid['success'] = false;
            $valid['messages'] = "Movie name already exist";
            echo json_encode($valid);
            exit();
        }

        $movie->update($id, $name, $genre);
        
    }


    // FETCH MOVIE
    if ($_SERVER['REQUEST_METHOD'] === "POST" && $_GET['action'] === "delete") {

        $id = $_POST['id'];

        if($movie->requiredInput($id) !== false){
            $valid['success'] = false;
            $valid['messages'] = "All fields cannot be empty";
            echo json_encode($valid);
            exit();
        }

        if($movie->exist($id, "id") !== true){
            $valid['success'] = false;
            $valid['messages'] = "Movie ID not found.";
            echo json_encode($valid);
            exit();
        }

        $movie->delete($id);

    }