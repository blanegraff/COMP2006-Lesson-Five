<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=utf-8;" http-equiv="content-type">
        <title>Beer Saved</title>
    </head>
    <body>
    <?php
    //gathering data from beer form and trasnferring it to db

    // capture the form inputs and store in variables. php stores form values into arrays. the HTML name attribute was used as a tag
    // to identify array. To access value from form, use php's built-in post collection symbol "$_" with name of input
    $name= $_POST['name'];
    $alcohol_content= $_POST['alcohol_content'];
    $domestic= $_POST['domestic'];
    $light= $_POST['light'];
    $price= $_POST['price'];

/*
    // display variable values
    echo $name . '<br />';
    echo $alcohol_content . '<br />';
    echo $domestic . '<br />';
    echo $light . '<br />';
    echo $price . '<br />';
*/
    //validate our inputs individually
    $ok = true;

    if (empty($name)) {
        echo 'name is required<br />';
        $ok = false;
    }
    if ( empty($alcohol_content) || !is_numeric($alcohol_content) || $alcohol_content < 0) {
        echo 'alcohol content is required and must be number 0 or greater<br />';
        $ok = false;
    }

    if (empty($price) || !is_numeric($price) || $price < 0) {
        echo 'price is required<br />';
        $ok = false;
    }

    //check if form is okay to save or not
    if ($ok == true) {


        // connect to db
        $conn = new PDO('mysql:host=sql.computerstudi.es; dbname=gc100087541', 'gc100087541', 'ttd2DPp8');

        // set up SQL command to populate SQL with all our variables in the form of placeholders/parameters to ensure the right datatype
        // is entered from user along with displaying special characters like single quote in a name like O'Reilly which would break SQL.
        // This also prevents SQL injection from user which involves writing code "DROP TABLE beer", "SELECT * FROM user" and getting our
        // sensitve info.
        $sql = "INSERT INTO beers (name, alcohol_content, domestic, light, price) VALUES (:name, :alcohol_content, :domestic, :light, :price)";

        // populate placeholder values with our with our variables by creating/preparing a command object (OOP sytax for PHP involved here)
        $cmd = $conn->prepare($sql);
        // fill each placeholder with input variables using the bindParam function
        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 50);
        $cmd->bindParam(':alcohol_content', $alcohol_content, PDO::PARAM_INT);
        $cmd->bindParam(':domestic', $domestic, PDO::PARAM_BOOL);
        $cmd->bindParam(':light', $light, PDO::PARAM_BOOL);
        $cmd->bindParam(':price', $light, PDO::PARAM_INT);

        // call the execute method
        $cmd->execute();

        // disconnect
        $conn = null;

        //show message after exeuction
        echo '<h1>Beer Saved</h1><br/>
    <a href="beer-table.php">View Beer Listings</a>';

    }

    ?>
    </body>


</html>