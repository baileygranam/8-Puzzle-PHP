<?php
  echo $_COOKIE['x'];
  echo $_COOKIE['y'];
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
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
            </tr>
            <tr>
                <td>8</td>
                <td> </td>
                <td>4</td>
            </tr>
            <tr>
                <td>7</td>
                <td>6</td>
                <td>5</td>
            </tr>
        </table>
        <br />
        <p id="dialog"></p>
        <input id="clickMe" type="button" value="Scramble" onclick="shuffle();" />
    </div>
    <script src="../js/puzzle.js"></script>

</body>
</html>