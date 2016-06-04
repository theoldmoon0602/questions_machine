<?php
/**
 * Created by PhpStorm.
 * User: TOMORI
 * Date: 2016/06/04
 * Time: 21:53
 */

require_once("define.php");
require_once("functions.php");

$problems = load_problems(PROBLEMS);
?>

<!doctype html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <title>Problems Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Problems Manager</h1>
    <div>
        <a class="button" href="create.php">Create New Problem</a>
        <a class="button" href="delete.php">Delete Existing Problem</a>
    </div>
    <ul>
        <?php for($i = 0; $i < count($problems); $i++): ?>
            <li><a class="button"  <?php if (is_problem_disabled($problems[$i])) { echo 'style="background-color: gray;"'; } ?> href="edit.php?id=<?php echo $i; ?>"><?php echo $problems[$i]["question"]; ?></a></li>
        <?php endfor; ?>
    </ul>
<p><a href="index.php">Go Back to Index Page</a></p>
</body>
</html>
