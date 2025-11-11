<?php
include("header.php");
?>

<?php
// Xử lý khi người dùng bấm submit
$kq = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = $_POST["a"];
    $b = $_POST["b"];
    $c = $_POST["c"];

    if (is_numeric($a) && is_numeric($b) && is_numeric($c)) {
        $a = floatval($a);
        $b = floatval($b);
        $c = floatval($c);

        if ($a > 0 && $b > 0 && $c > 0 && ($a + $b > $c) && ($a + $c > $b) && ($b + $c > $a)) {
            if ($a == $b && $b == $c) {
                $kq = "🔺 Đây là <b>tam giác đều</b>";
            } elseif ($a == $b || $a == $c || $b == $c) {
                if (pow($a,2) + pow($b,2) == pow($c,2) ||
                    pow($a,2) + pow($c,2) == pow($b,2) ||
                    pow($b,2) + pow($c,2) == pow($a,2)) {
                    $kq = "🔺 Đây là <b>tam giác vuông cân</b>";
                } else {
                    $kq = "🔺 Đây là <b>tam giác cân</b>";
                }
            } elseif (pow($a,2) + pow($b,2) == pow($c,2) ||
                      pow($a,2) + pow($c,2) == pow($b,2) ||
                      pow($b,2) + pow($c,2) == pow($a,2)) {
                $kq = "🔺 Đây là <b>tam giác vuông</b>";
            } else {
                $kq = "🔺 Đây là <b>tam giác thường</b>";
            }
        } else {
            $kq = "❌ Ba cạnh này <b>không tạo thành tam giác</b>";
        }
    } else {
        $kq = "⚠️ Vui lòng nhập số hợp lệ";
    }
}
?>


    <div class="card">
        <h2>🔎 Kiểm tra tam giác</h2>
        <form method="post" action="">
            <input type="text" name="a" placeholder="Nhập cạnh a" required><br>
            <input type="text" name="b" placeholder="Nhập cạnh b" required><br>
            <input type="text" name="c" placeholder="Nhập cạnh c" required><br>
            <input type="submit" value="Kiểm tra">
        </form>
        <?php if ($kq != ""): ?>
            <div class="result"><?php echo $kq; ?></div>
        <?php endif; ?>
    </div>
<?php
include("footer.php");
?>
