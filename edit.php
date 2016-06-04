<?php
/**
 * Created by PhpStorm.
 * User: TOMORI
 * Date: 2016/06/04
 * Time: 22:30
 */

require_once ("define.php");
require_once ("functions.php");

$p = null;
$res = null;

session_start();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $problems = load_problems(PROBLEMS);

    if (isset($_GET["question"])) {
        if ($_GET["id"] !== $_SESSION["id"]) {
            $res = false;
        } else {
            $id = intval($id);
            $problems[$id] = [
                "question" => validate($_GET["question"]),
                "correct" => validate($_GET["correct"]),
                "type" => $problems[$id]["type"]
            ];
            $res = save_problems(PROBLEMS, $problems);
            session_destroy();
        }
    } else {
        $_SESSION["id"] = $id;

        $p = $problems[intval($id)];
    }
}

?>
<!doctype html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <title>Edit Existing Problem</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php if ($res): ?>
    <p>Succeed to Update Existing Problem</p>
<?php endif; ?>
<h1>Edit Existing Problem</h1>
<form action="">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <table>
        <tr><td>問題文</td><td><input type="text" name="question" value="<?php echo $p['question']; ?>" /></td></tr>
        <tr><td>答え</td><td><input type="text" name="correct"  value="<?php echo $p['correct']; ?>"/></td></tr>
    </table>
    <input class="button" type="submit" value="Save">
</form>
<p><a href="manager.php">Go Back to Manager View</a></p>
</body>
</html>
