
<?php 

/* Load the Puzzle class. */
require_once('../Models/Puzzle.php');

/* Start a session. */
session_start(); 

/* Create new puzzle object. */
$puzzle = new Puzzle();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>8 Puzzle</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Customized CSS -->
    <link rel="stylesheet" href="../css/styles.css">

</head>
<body>
    <div class="container text-center" style="margin-top:18vh;">
        <h2>8 Puzzle</h2>
        <table id="tableID" style="cursor: pointer;" class="mx-auto align-middle">
            <?php
                for($i = 0; $i < 3; $i++)
                {
                    echo "<tr>";
                    for($j = 0; $j < 3; $j++)
                    {
                        echo "<td>";
                        print($_SESSION['table'][$i][$j]);
                        echo "</td>";
                    }
                    echo "</tr>";
                }
            ?>
        </table>
        <br />
        <p id="dialog"><?php echo $_SESSION['dialog']; ?></p>
        <form action="" method="POST">
            <input type="submit" value="Reset" name="action">
            <input type="submit" value="Scramble" name="action">
        </form>
        
    </div>
    <script src="../js/puzzle.js"></script>
</body>
</html>