<?php
include("header.php");
?>
<?php
/* Dùng php để viết chương trình giải phương trình bậc 2: ax^2 + bx +c = 0 với a, b, c nhập từ bàn phím.
Nếu khi nhập a = 0 thì viết chương trình con, giải phương trình bậc 1. (Không giữ lại form sau khi thực thi.) */

function giaiBac1($a, $b):String{
    if ($a == 0) {
        if ($b == 0) {
            return "Phương trình có vô số nghiệm";
        } else {
            return "Phương trình vô nghiệm";
        }
    } else {
        $x = -$b / $a;
        return "Nghiệm của phương trình bậc 1: x = " . round($x, 4);
    }
}

function giaiBac2($a, $b, $c):String{ 
    if ($a == 0) {
        return giaiBac1($b, $c);
    }
    else{
        $delta = $b * $b - 4 * $a * $c;

        if ($delta > 0) {
            $x1 = (-$b + sqrt($delta)) / (2 * $a);
            $x2 = (-$b - sqrt($delta)) / (2 * $a);
            return "Phương trình có 2 nghiệm phân biệt:<br>x1 = " . round($x1, 4) . "<br>x2 = " . round($x2, 4);
        } elseif ($delta == 0) {
            $x = -$b / (2 * $a);
            return "Phương trình có nghiệm kép: x = " . round($x, 4);
        } else {    
            return "Phương trình vô nghiệm (delta < 0)";
        }
    }
}

$ketqua="";

if ($_POST){
    $a = floatval($_POST['a']);
    $b = floatval($_POST['b']);      
    $c = floatval($_POST['c']);

    if($a == 0){
        $ketqua = giaiBac1($b, $c);
    }
    else{
        $ketqua = giaiBac2($a, $b, $c);
    }
}
?>


    <div class="container">
        <h1>Giải Phương Trình Bậc 2</h1>
        
        <div class="equation">
            ax² + bx + c = 0
        </div>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="a">Hệ số a:</label>
                <input type="number" step="any" name="a" id="a" required placeholder="Nhập hệ số a">
            </div>
            
            <div class="form-group">
                <label for="b">Hệ số b:</label>
                <input type="number" step="any" name="b" id="b" required placeholder="Nhập hệ số b">
            </div>
            
            <div class="form-group">
                <label for="c">Hệ số c:</label>
                <input type="number" step="any" name="c" id="c" required placeholder="Nhập hệ số c">
            </div>
            
            <button type="submit">Giải Phương Trình</button>
        </form>
        
        <?php if (!empty($ketqua)): ?>
        <div class="result">
            <h3>Kết quả:</h3>
            <p><?php echo $ketqua; ?></p>
        </div>
        <?php endif; ?>
        
        <div class="note">
            <strong>Lưu ý:</strong>
            <ul>
                <li>Nếu a = 0: Chương trình sẽ giải phương trình bậc 1 (bx + c = 0)</li>
                <li>Nếu a ≠ 0: Chương trình sẽ giải phương trình bậc 2</li>
                <li>Kết quả sẽ hiển thị trong popup và form sẽ được làm mới</li>
            </ul>
        </div>
    </div>
<?php
include("footer.php");
?>