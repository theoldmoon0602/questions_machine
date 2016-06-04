<?php
/**
 * Created by PhpStorm.
 * User: TOMORI
 * Date: 2016/06/04
 * Time: 16:54
 */

require_once ("define.php");
require_once("functions.php");

if (!isset($_GET["s"]) || !isset($_GET["n"])) {
    header("Location: index.php");
    exit();
}

$seed = intval($_GET["s"]);
$num = intval($_GET["n"]);

$xs = load_problems(PROBLEMS);
$xs = shuffle_problems($xs, $seed);
$p = $xs[$num];

function shuffle_problems($xs, $s)
{
    mt_srand($s);

    for ($i = count($xs)-1; $i > 0; $i--){
        $j = mt_rand(0, $i);
        list($xs[$i], $xs[$j]) = [$xs[$j], $xs[$i]]; //swap
    }

    return $xs;
}



function draw_answer_form($p)
{
    switch ($p["type"]) {
        case "qa":
            echo <<<HTML
<div id="answer" class="text-form" contenteditable="true" onkeydown="if (event.keyCode === 13) { submit_func(); event.preventDefault(); }"></div>
HTML;
            break;
    }
}

function draw_correct_answer($p)
{
    switch ($p["type"]) {
        case "qa":
            echo $p["correct"];
            break;
    }
}

function write_focus_script($p)
{
    switch ($p["type"]) {
        case "qa":
            echo <<<JS
document.getElementById("answer").focus();
JS;
            break;

    }
}

?>
<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title><?php echo PAGE; ?></title>
    <link rel="stylesheet" href="style.css">
    <style>
        .text-form {
            border: 1px #cccccc solid;
        }

        #correct {
            visibility: hidden;
        }
    </style>
</head>
<body>
<h1><?php echo PAGE; ?></h1>
<?php if ($num >= count($xs)): ?>

    <p>Congrats! You Cleared All Questions!</p>
    <p><a class="button" href="index.php">Back to Top Page</a></p>

<?php else: ?>

    <p><?php echo ($num + 1) . "/" . count($xs); ?></p>
    <p id="question"><?php echo $p["question"]; ?></p>
    <form id="submit" action="">
        <input type="hidden" name="s" value="<?php echo $seed; ?>"/>
        <input type="hidden" name="n" value="<?php echo $num + 1; ?>"/>
        <?php draw_answer_form($p); ?>
    </form>

    <div id="correct">
        <?php draw_correct_answer($p); ?>
    </div>
    
    <p>
        <button class="button" id="view-correct">View Answer</button>
        <a class="button" href="problem.php?s=<?php echo $seed; ?>&n=<?php echo $num + 1; ?>">Skip This Problem</a>
    </p>

    <p>
        <a class="button" href="index.php">Back to Top</a>
    </p>
    <script>
        var correct = "<?php echo $p['correct']; ?>";

        function get_answer() {
            <?php if ($p["type"] === "qa"): ?>
            return document.getElementById("answer").textContent.trim();
            <?php endif; ?>
        }

        function answer_check() {
            <?php if ($p["type"] === "qa"): ?>
            var answer = get_answer();
            if (correct === answer) {
                return true;
            }
            <?php endif; ?>

            return false;
        }

        function text_different_point(a, b) {
            for (var i = 0; i < a.length; i++) {
                if (a[i] !== b[i]) {
                    return i;
                }
                if (i == b.length) {
                    return i;
                }
            }
            return a.length;
        }

        function emphasize_wrong() {
            <?php if ($p["type"] === "qa"): ?>
            var i = text_different_point(correct, get_answer());
            var ans = get_answer();
            var red = ans.substr(0, i) + "<span style='color: red;'>" + ans[i] + "</span>" + ans.substr(i + 1);
            document.getElementById("answer").innerHTML = red;
            <?php endif; ?>
        }

        function submit_func() {
            if (!answer_check()) {
                emphasize_wrong();
                return false;
            }
            document.getElementById("submit").submit();
            return true;
        }

        document.getElementById("view-correct").addEventListener("click", function () {
           document.getElementById("correct").style.visibility = "visible";
        });

        <?php write_focus_script($p); ?>

    </script>

<?php endif; ?>
</body>
</html>
