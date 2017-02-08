<?php
/**
 * Created by PhpStorm.
 * User: TOMORI
 * Date: 2016/06/04
 * Time: 22:03
 */

require_once ("define.php");
require_once ("functions.php");

$result = null;
if (isset($_GET["question"])) {
    $problems = load_problems(PROBLEMS);
    $problems []= [
        "question" => validate($_GET["question"]),
        "correct" => ($_GET["correct"]),
        "type" => validate($_GET["type"])
    ];
   $result = save_problems(PROBLEMS, $problems);
}
?>
<!doctype html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <title>Create New Problem</title>
    <link rel="stylesheet" href="style.css">
    <style>
        input[type=text] {
            padding: 0.1em;
            border: 1px solid #cccccc;
            border-radius: 2px;
            min-width: 50em;
        }
    </style>
</head>
<body>
    <?php if ($result): ?>
        <p>Succeeded to Add Problem.</p>
    <?php endif; ?>
    <h1>Create New Problem</h1>
    <form action="">
        <table>
            <tr><td>問題文</td><td><textarea name="question"></textarea></td></tr>
            <tr><td>答え</td><td><input type="text" name="correct" /></td></tr>
            <tr><td>種類</td><td>
                    <select name="type" id="">
                        <option value="qa" selected>Q&A</option>
                        <option value="re">Q&A(regular expression)</option>
                    </select>
                </td></tr>
        </table>
        <input class="button" type="submit" value="Create">
    </form>
    <p><a href="manager.php">Go Back to Management View</a></p>

</body>
</html>
