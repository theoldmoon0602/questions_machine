<?php

require_once ("define.php");
?>

<!doctype html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <title><?php echo PAGE; ?></title>
    <link rel="stylesheet" href="style.css">
    <style>
        html {
            height: 100%;
            box-sizing: border-box;
            margin: 0;
        }
        body {
            height: 100%;
            box-sizing: border-box;
            margin: 0;
        }
        #centering {
            height: 100%;
            display: flex;
            justify-content: center;
            flex-direction: column;

            text-align: center;
        }
        footer {
            display: block;
            width: 100%;

            border-top: 1px solid #cccccc;

            position: fixed;
            bottom: 0;

            padding-left: 1em;
            padding-bottom: 5px;
        }
    </style>
</head>
<body>
<div id="centering">
    <h1><?php echo PAGE; ?></h1>
    <form action="problem.php">
        <input type="hidden" name="s" id="s"/>
        <input type="hidden" name="n" value="0"/>
        <input type="submit" value="start" class="button">
    </form>
</div>
<footer>
    <a href="manager.php">Go to Management View</a>
</footer>
<script>
    document.addEventListener("DOMContentLoaded", function (){
        console.log(this);
        var min = 1;
        var max = 100000;
        document.getElementById("s").value = getRandomIntInclusive(min, max);
    });
    function getRandomIntInclusive(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }
</script>
</body>
</html>