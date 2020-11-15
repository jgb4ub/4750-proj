<?php
require("projectconnectdb.php");
require("restaurant.php");

?>
<!DOCTYPE HTML>
<html>
<head>
<style>
    .error {color: #FF0000;}
</style>
</head>
<body>

    <?php
    // define variables and set to empty values
    $nameErr = $typeErr = $phoneErr = $priceErr = "";
    $name = $type = $phone = $phoneTemp = $price = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Restaurant name is required";
        } else {
            $name = test_input($_POST["name"]);

            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["type"])) {
            $typeErr = "Type is required";
        } else {
            $type = test_input($_POST["type"]);
            // check if e-mail address is well-formed

        }

        $phoneTemp = preg_replace('/[^0-9]/', '', $_POST['phoneTemp']);

        if(strlen($phoneTemp) !== 10) {
            $phoneErr = "Please enter a real phone number";
        }

        $phone = substr($phoneTemp, 0, 3)."-".substr($phoneTemp, -7, -4)."-".substr($phoneTemp, -4);

        if (empty($_POST["price"])) {
            $priceErr = "Price is required";
        } else {
            $price = test_input($_POST["price"]);
        }

        if (empty($nameErr) && empty($typeErr) && empty($phoneErr) && empty($priceErr)){
            makeRestaurant($name, $type, $phone, $price);
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <h2>Restaurant Entry</h2>
    <p><span class="error">* required field</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Restaurant Name: <input type="text" name="name" value="<?php echo $name;?>">
        <span class="error">* <?php echo $nameErr;?></span>
        <br><br>
        Type: <input type="text" name="type" value="<?php echo $type;?>">
        <span class="error">* <?php echo $typeErr;?></span>
        <br><br>
        Phone: <input type="text" name="phoneTemp" value="<?php echo $phone;?>">
        <span class="error">*<?php echo $phoneErr;?></span>
        <br><br>
        Price:
        <input type="radio" name="price" <?php if (isset($price) && $price=="$") echo "checked";?> value="$">$
        <input type="radio" name="price" <?php if (isset($price) && $price=="$$") echo "checked";?> value="$$">$$
        <input type="radio" name="price" <?php if (isset($price) && $price=="$$$") echo "checked";?> value="$$$">$$$
        <span class="error">* <?php echo $priceErr;?></span>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    /**echo "<h2>Your Input:</h2>";
    echo $name;
    echo "<br>";
    echo $type;
    echo "<br>";
    echo $phone;
    echo "<br>";
    echo $price;*/
    ?>

</body>
</html>
