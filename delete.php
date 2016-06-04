<?php
/**
 * Created by PhpStorm.
 * User: TOMORI
 * Date: 2016/06/04
 * Time: 22:46
 */
require_once("define.php");
require_once("functions.php");

$problems = load_problems(PROBLEMS);
$res = null;
if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    if (!(0 <= $id && $id < count($problems))) {
        $res = false;
    } else {
        unset($problems[$id]);
        $problems = array_values($problems);
        $res = save_problems(PROBLEMS, $problems);
    }
}
?>

<!doctype html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <title>Delete Existing Problem</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php if ($res): ?>
    <p>Succeeded to Delete Existed Problem</p>
<?php endif; ?>
<ul>
    <?php for($i = 0; $i < count($problems); $i++): ?>
        <li><a class="button" href="delete.php?id=<?php echo $i; ?>"><?php echo $problems[$i]["question"]; ?></a></li>
    <?php endfor; ?>
</ul>
<p><a href="manager.php">Go Back to Management View</a></p>
</body>
</html>