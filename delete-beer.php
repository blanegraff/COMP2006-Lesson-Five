<?php ob_start();

// Identify the record the user wants to delete
$beer_id= null;
$beer_id = $_GET['beer_id'];

if (is_numeric($beer_id)) {
      // connection
      $conn = new PDO('mysql:host=sql.computerstudi.es; dbname=gc100087541', 'gc100087541', 'ttd2DPp8');

      // Prepare and execute the SQL delete command
      $sql = "DELETE FROM beers WHERE beer_id = :beer_id";

      $cmd = $conn->prepare($sql);
      $cmd->bindParam(':beer_id', $beer_id, PDO::PARAM_INT);
      $cmd->execute();

      // Disconnect
      $conn = null;

      // Redirect back to the updated beers.php
      header('location:beer.php');
}

ob_flush(); ?>