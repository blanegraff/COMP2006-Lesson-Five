<!DOCTYPE html>
<html>
<head>
    <meta content="text/html"; charset="UTF-8" http-equiv="content-type">
    <title>Beer Table</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    </head>
</head>
<body>

<h1>Beer Table</h1>

<a href="beer.php" title="Add Beer">Add a beer</a>
<?php
//connect
$conn = new PDO('mysql:host=sql.computerstudi.es; dbname=gc100087541', 'gc100087541', 'ttd2DPp8');

//write select query and prepare the query
$sql = "SELECT * FROM beers ORDER BY name";
$cmd = $conn->prepare($sql);

//run the query and store the results into an array
$cmd -> execute();
$beers = $cmd -> fetchAll();

//start the table with html
echo '<table class="table table-striped"><thead><th>Name</th><th>Alcohol Content</th>
    <th>Domestic</th><th>Light</th><th>Price</th></thead><tbody>';

//loop throuhg the data, displaying each beer along wiht its values in a new row
foreach($beers as $beer) {
    echo '<tr><td>' . $beer['name'] . '</td>
        <td>' . $beer['alcohol_content'] . '</td>
        <td>' . $beer['domestic'] . '</td>
        <td>' . $beer['light'] . '</td>
        <td>' . $beer['price'] . '</td>
        <td><a href="delete-beer.php?beer_id=' . $beer['beer_id'] . '" title="Delete" class="confirmation">Delete</a></td>
        </tr>';
}
//close the table
echo '</tbody></table>';

//disconnect
$conn = null

?>

<!-- Js Section -->
     <script src="Script/lib/jquery-2.2.0.min.js"></script>
     <script src="Script/app.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>

