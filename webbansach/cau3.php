<?php
include("header.php");
?>

<?php
function giaiPhuongTrinhBac1($b, $c) {
    if ($b == 0) {
        if ($c == 0) {
            return "Phương trình vô số nghiệm.";
        } else {
            return "Phương trình vô nghiệm.";
        }
    } else {
        $x = -$c / $b;
        return "Nghiệm của phương trình bậc 1: x = $x";
    }
}

function giaiPhuongTrinhBac2($a, $b, $c) {
    if ($a == 0) {
        return giaiPhuongTrinhBac1($b, $c);
    }
    $delta = $b * $b - 4 * $a * $c;
    if ($delta > 0) {
        $x1 = (-$b + sqrt($delta)) / (2 * $a);
        $x2 = (-$b - sqrt($delta)) / (2 * $a);
        return "Phương trình có 2 nghiệm phân biệt: x1 = $x1, x2 = $x2";
    } elseif ($delta == 0) {
        $x = -$b / (2 * $a);
        return "Phương trình có nghiệm kép: x = $x";
    } else {
        $phanThuc = -$b / (2 * $a);
        $phanAo = sqrt(-$delta) / (2 * $a);
        return "Phương trình có 2 nghiệm phức: x1 = {$phanThuc}+{$phanAo}i, x2 = {$phanThuc}-{$phanAo}i";
    }
}

$a = $b = $c = "";
$ketQua = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = $_POST["a"];
    $b = $_POST["b"];
    $c = $_POST["c"];
    if (is_numeric($a) && is_numeric($b) && is_numeric($c)) {
        $ketQua = giaiPhuongTrinhBac2($a, $b, $c);
    } else {
        $ketQua = "Vui lòng nhập số hợp lệ cho a, b, c.";
    }
}
?>


    <div class="container">
        <h2>Giải phương trình bậc 2</h2>
        <form method="post">
            <label for="a">Hệ số a:</label>
            <input type="text" id="a" name="a" value="<?php echo htmlspecialchars($a); ?>">

            <label for="b">Hệ số b:</label>
            <input type="text" id="b" name="b" value="<?php echo htmlspecialchars($b); ?>">

            <label for="c">Hệ số c:</label>
            <input type="text" id="c" name="c" value="<?php echo htmlspecialchars($c); ?>">

            <input type="submit" value="Giải phương trình">
        </form>

        <?php if ($ketQua != ""): ?>
            <div class="result"><?php echo $ketQua; ?></div>
        <?php endif; ?>
    </div>
<?php
include("footer.php");
?>
