<?php
include("header.php");
?>

<?php
// Xử lý dữ liệu gửi lên
$shape = $_POST['shape'] ?? '';
$mode = $_POST['mode'] ?? 'area'; // area | perimeter
$result = null;
$resultLabel = '';
$error = '';

// Hàm an toàn khi in ra HTML
function h(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($mode === 'area') {
        switch ($shape) {
            case 'circle':
                $radius = isset($_POST['radius']) ? (float)$_POST['radius'] : 0;
                if ($radius <= 0) {
                    $error = 'Bán kính phải lớn hơn 0.';
                } else {
                    $result = pi() * $radius * $radius; // S = πr²
                    $resultLabel = 'Diện tích';
                }
                break;

            case 'triangle':
                $base = isset($_POST['base']) ? (float)$_POST['base'] : 0;
                $height = isset($_POST['height_triangle']) ? (float)$_POST['height_triangle'] : 0;
                if ($base <= 0 || $height <= 0) {
                    $error = 'Cạnh đáy và chiều cao tam giác phải lớn hơn 0.';
                } else {
                    $result = 0.5 * $base * $height; // S = 1/2 * a * h
                    $resultLabel = 'Diện tích';
                }
                break;

            case 'rectangle':
                $width = isset($_POST['width']) ? (float)$_POST['width'] : 0;
                $height = isset($_POST['height_rectangle']) ? (float)$_POST['height_rectangle'] : 0;
                if ($width <= 0 || $height <= 0) {
                    $error = 'Chiều dài và chiều rộng phải lớn hơn 0.';
                } else {
                    $result = $width * $height; // S = a * b
                    $resultLabel = 'Diện tích';
                }
                break;

            default:
                $error = 'Chế độ Diện tích hiện chỉ hỗ trợ: Hình tròn, Tam giác, Hình chữ nhật.';
        }
    } elseif ($mode === 'perimeter') {
        switch ($shape) {
            case 'circle':
                $radius = isset($_POST['radius']) ? (float)$_POST['radius'] : 0;
                if ($radius <= 0) {
                    $error = 'Bán kính phải lớn hơn 0.';
                } else {
                    $result = 2 * pi() * $radius; // P = 2πr
                    $resultLabel = 'Chu vi';
                }
                break;

            case 'triangle': // chu vi tam giác bất kỳ
                $a = isset($_POST['side_a']) ? (float)$_POST['side_a'] : 0;
                $b = isset($_POST['side_b']) ? (float)$_POST['side_b'] : 0;
                $c = isset($_POST['side_c']) ? (float)$_POST['side_c'] : 0;
                if ($a <= 0 || $b <= 0 || $c <= 0) {
                    $error = 'Ba cạnh tam giác phải lớn hơn 0.';
                } else {
                    $result = $a + $b + $c;
                    $resultLabel = 'Chu vi';
                }
                break;

            case 'equilateral_triangle': // tam giác đều
                $a = isset($_POST['eq_side']) ? (float)$_POST['eq_side'] : 0;
                if ($a <= 0) {
                    $error = 'Cạnh tam giác đều phải lớn hơn 0.';
                } else {
                    $result = 3 * $a;
                    $resultLabel = 'Chu vi';
                }
                break;

            case 'isosceles_triangle': // tam giác cân (2 cạnh bên bằng nhau)
                $a = isset($_POST['iso_equal']) ? (float)$_POST['iso_equal'] : 0;
                $b = isset($_POST['iso_base']) ? (float)$_POST['iso_base'] : 0;
                if ($a <= 0 || $b <= 0) {
                    $error = 'Cạnh bên và cạnh đáy phải lớn hơn 0.';
                } else {
                    $result = 2 * $a + $b;
                    $resultLabel = 'Chu vi';
                }
                break;

            case 'rectangle': // HCN cũng là hình bình hành đặc biệt
                $a = isset($_POST['width']) ? (float)$_POST['width'] : 0;
                $b = isset($_POST['height_rectangle']) ? (float)$_POST['height_rectangle'] : 0;
                if ($a <= 0 || $b <= 0) {
                    $error = 'Chiều dài và chiều rộng phải lớn hơn 0.';
                } else {
                    $result = 2 * ($a + $b);
                    $resultLabel = 'Chu vi';
                }
                break;

            case 'parallelogram': // hình bình hành
                $a = isset($_POST['para_a']) ? (float)$_POST['para_a'] : 0;
                $b = isset($_POST['para_b']) ? (float)$_POST['para_b'] : 0;
                if ($a <= 0 || $b <= 0) {
                    $error = 'Hai cạnh kề của hình bình hành phải lớn hơn 0.';
                } else {
                    $result = 2 * ($a + $b);
                    $resultLabel = 'Chu vi';
                }
                break;

            case 'rhombus': // hình thoi: 4 cạnh bằng nhau
                $a = isset($_POST['rhombus_side']) ? (float)$_POST['rhombus_side'] : 0;
                if ($a <= 0) {
                    $error = 'Cạnh hình thoi phải lớn hơn 0.';
                } else {
                    $result = 4 * $a;
                    $resultLabel = 'Chu vi';
                }
                break;

            default:
                $error = 'Vui lòng chọn một hình để tính chu vi.';
        }
    }
}
?>

    <div class="card">
        <div class="header">
            <h1><i class="fas fa-calculator"></i> Tính diện tích hình học</h1>
            <div class="subtitle">Chọn một hình bên dưới và nhập thông số để tính diện tích một cách chính xác</div>
        </div>

        <form method="post" action="">
            <div class="modes actions" style="margin-bottom:12px;">
                <label class="shape-option">
                    <input type="radio" name="mode" value="area" <?php echo $mode==='area' ? 'checked' : ''; ?> onchange="this.form.submit()">
                    <div class="shape-card" style="padding:10px 14px;">
                        <div class="shape-name">Diện tích</div>
                    </div>
                </label>
                <label class="shape-option">
                    <input type="radio" name="mode" value="perimeter" <?php echo $mode==='perimeter' ? 'checked' : ''; ?> onchange="this.form.submit()">
                    <div class="shape-card" style="padding:10px 14px;">
                        <div class="shape-name">Chu vi</div>
                    </div>
                </label>
            </div>
            <div class="shapes">
                <label class="shape-option">
                    <input type="radio" name="shape" value="circle" <?php echo $shape==='circle' ? 'checked' : ''; ?> onchange="onShapeChange('circle')">
                    <div class="shape-card">
                        <div class="shape-icon">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="shape-name">Hình Tròn</div>
                        <div class="shape-formula">S = π × r²</div>
                    </div>
                </label>

                <label class="shape-option">
                    <input type="radio" name="shape" value="triangle" <?php echo $shape==='triangle' ? 'checked' : ''; ?> onchange="onShapeChange('triangle')">
                    <div class="shape-card">
                        <div class="shape-icon">
                            <i class="fas fa-play" style="transform: rotate(90deg);"></i>
                        </div>
                        <div class="shape-name">Tam Giác</div>
                        <div class="shape-formula"><?php echo $mode==='area' ? 'S = 1/2 × a × h' : 'P = a + b + c'; ?></div>
                    </div>
                </label>

                <label class="shape-option">
                    <input type="radio" name="shape" value="rectangle" <?php echo $shape==='rectangle' ? 'checked' : ''; ?> onchange="onShapeChange('rectangle')">
                    <div class="shape-card">
                        <div class="shape-icon">
                            <i class="far fa-square"></i>
                        </div>
                        <div class="shape-name">Hình Chữ Nhật</div>
                        <div class="shape-formula"><?php echo $mode==='area' ? 'S = a × b' : 'P = 2 × (a + b)'; ?></div>
                    </div>
                </label>

                <!-- Chu vi: Hình bình hành -->
                <label class="shape-option">
                    <input type="radio" name="shape" value="parallelogram" <?php echo $shape==='parallelogram' ? 'checked' : ''; ?> onchange="onShapeChange('parallelogram')">
                    <div class="shape-card">
                        <div class="shape-icon">
                            <i class="fas fa-grip-lines"></i>
                        </div>
                        <div class="shape-name">Hình Bình Hành</div>
                        <div class="shape-formula">P = 2 × (a + b)</div>
                    </div>
                </label>

                <!-- Chu vi: Hình thoi -->
                <label class="shape-option">
                    <input type="radio" name="shape" value="rhombus" <?php echo $shape==='rhombus' ? 'checked' : ''; ?> onchange="onShapeChange('rhombus')">
                    <div class="shape-card">
                        <div class="shape-icon">
                            <i class="fas fa-diamond"></i>
                        </div>
                        <div class="shape-name">Hình Thoi</div>
                        <div class="shape-formula">P = 4 × a</div>
                    </div>
                </label>

                <!-- Chu vi: Tam giác đều -->
                <label class="shape-option">
                    <input type="radio" name="shape" value="equilateral_triangle" <?php echo $shape==='equilateral_triangle' ? 'checked' : ''; ?> onchange="onShapeChange('equilateral_triangle')">
                    <div class="shape-card">
                        <div class="shape-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="shape-name">Tam Giác Đều</div>
                        <div class="shape-formula">P = 3 × a</div>
                    </div>
                </label>

                <!-- Chu vi: Tam giác cân -->
                <label class="shape-option">
                    <input type="radio" name="shape" value="isosceles_triangle" <?php echo $shape==='isosceles_triangle' ? 'checked' : ''; ?> onchange="onShapeChange('isosceles_triangle')">
                    <div class="shape-card">
                        <div class="shape-icon">
                            <i class="fas fa-delta"></i>
                        </div>
                        <div class="shape-name">Tam Giác Cân</div>
                        <div class="shape-formula">P = 2 × a + b</div>
                    </div>
                </label>
            </div>

            <div class="inputs">
                <div id="inputs-circle" class="input-group hidden">
                    <div class="field">
                        <label for="radius">
                            <i class="fas fa-ruler-horizontal"></i>
                            Bán kính (r)
                        </label>
                        <input type="text" inputmode="decimal" name="radius" id="radius" value="<?php echo isset($_POST['radius']) ? h((string)$_POST['radius']) : ''; ?>" oninput="normalizeNumberInput(this)" placeholder="Ví dụ: 3.5">
                    </div>
                </div>

                <div id="inputs-triangle" class="input-group hidden">
                    <div class="field">
                        <?php if ($mode === 'area'): ?>
                            <label for="base">
                                <i class="fas fa-arrows-alt-h"></i>
                                Cạnh đáy (a)
                            </label>
                            <input type="text" inputmode="decimal" name="base" id="base" value="<?php echo isset($_POST['base']) ? h((string)$_POST['base']) : ''; ?>" oninput="normalizeNumberInput(this)" placeholder="Ví dụ: 5">
                        <?php else: ?>
                            <label for="side_a">
                                <i class="fas fa-ruler-combined"></i>
                                Cạnh a
                            </label>
                            <input type="text" inputmode="decimal" name="side_a" id="side_a" value="<?php echo isset($_POST['side_a']) ? h((string)$_POST['side_a']) : ''; ?>" oninput="normalizeNumberInput(this)" placeholder="Ví dụ: 5">
                        <?php endif; ?>
                    </div>
                    <div class="field">
                        <?php if ($mode === 'area'): ?>
                            <label for="height_triangle">
                                <i class="fas fa-arrows-alt-v"></i>
                                Chiều cao (h)
                            </label>
                            <input type="text" inputmode="decimal" name="height_triangle" id="height_triangle" value="<?php echo isset($_POST['height_triangle']) ? h((string)$_POST['height_triangle']) : ''; ?>" oninput="normalizeNumberInput(this)" placeholder="Ví dụ: 4">
                        <?php else: ?>
                            <label for="side_b">
                                <i class="fas fa-ruler-combined"></i>
                                Cạnh b
                            </label>
                            <input type="text" inputmode="decimal" name="side_b" id="side_b" value="<?php echo isset($_POST['side_b']) ? h((string)$_POST['side_b']) : ''; ?>" oninput="normalizeNumberInput(this)" placeholder="Ví dụ: 4">
                        <?php endif; ?>
                    </div>
                    <?php if ($mode === 'perimeter'): ?>
                    <div class="field">
                        <label for="side_c">
                            <i class="fas fa-ruler-combined"></i>
                            Cạnh c
                        </label>
                        <input type="text" inputmode="decimal" name="side_c" id="side_c" value="<?php echo isset($_POST['side_c']) ? h((string)$_POST['side_c']) : ''; ?>" oninput="normalizeNumberInput(this)" placeholder="Ví dụ: 6">
                    </div>
                    <?php endif; ?>
                </div>

                <div id="inputs-rectangle" class="input-group hidden">
                    <div class="field">
                        <label for="width">
                            <i class="fas fa-arrows-alt-h"></i>
                            Chiều dài (a)
                        </label>
                        <input type="text" inputmode="decimal" name="width" id="width" value="<?php echo isset($_POST['width']) ? h((string)$_POST['width']) : ''; ?>" oninput="normalizeNumberInput(this)" placeholder="Ví dụ: 6">
                    </div>
                    <div class="field">
                        <label for="height_rectangle">
                            <i class="fas fa-arrows-alt-v"></i>
                            Chiều rộng (b)
                        </label>
                        <input type="text" inputmode="decimal" name="height_rectangle" id="height_rectangle" value="<?php echo isset($_POST['height_rectangle']) ? h((string)$_POST['height_rectangle']) : ''; ?>" oninput="normalizeNumberInput(this)" placeholder="Ví dụ: 2.5">
                    </div>
                </div>

                <!-- Chu vi: Hình thoi -->
                <div id="inputs-rhombus" class="input-group hidden">
                    <div class="field">
                        <label for="rhombus_side">
                            <i class="fas fa-diamond"></i>
                            Cạnh (a)
                        </label>
                        <input type="text" inputmode="decimal" name="rhombus_side" id="rhombus_side" value="<?php echo isset($_POST['rhombus_side']) ? h((string)$_POST['rhombus_side']) : ''; ?>" oninput="normalizeNumberInput(this)" placeholder="Ví dụ: 5">
                    </div>
                </div>

                <!-- Chu vi: Hình bình hành -->
                <div id="inputs-parallelogram" class="input-group hidden">
                    <div class="field">
                        <label for="para_a">
                            <i class="fas fa-ruler-horizontal"></i>
                            Cạnh a
                        </label>
                        <input type="text" inputmode="decimal" name="para_a" id="para_a" value="<?php echo isset($_POST['para_a']) ? h((string)$_POST['para_a']) : ''; ?>" oninput="normalizeNumberInput(this)" placeholder="Ví dụ: 7">
                    </div>
                    <div class="field">
                        <label for="para_b">
                            <i class="fas fa-ruler-vertical"></i>
                            Cạnh b
                        </label>
                        <input type="text" inputmode="decimal" name="para_b" id="para_b" value="<?php echo isset($_POST['para_b']) ? h((string)$_POST['para_b']) : ''; ?>" oninput="normalizeNumberInput(this)" placeholder="Ví dụ: 4">
                    </div>
                </div>

                <!-- Chu vi: Tam giác đều -->
                <div id="inputs-equilateral_triangle" class="input-group hidden">
                    <div class="field">
                        <label for="eq_side">
                            <i class="fas fa-triangle-exclamation"></i>
                            Cạnh (a)
                        </label>
                        <input type="text" inputmode="decimal" name="eq_side" id="eq_side" value="<?php echo isset($_POST['eq_side']) ? h((string)$_POST['eq_side']) : ''; ?>" oninput="normalizeNumberInput(this)" placeholder="Ví dụ: 5">
                    </div>
                </div>

                <!-- Chu vi: Tam giác cân -->
                <div id="inputs-isosceles_triangle" class="input-group hidden">
                    <div class="field">
                        <label for="iso_equal">
                            <i class="fas fa-ruler-combined"></i>
                            Cạnh bên (a)
                        </label>
                        <input type="text" inputmode="decimal" name="iso_equal" id="iso_equal" value="<?php echo isset($_POST['iso_equal']) ? h((string)$_POST['iso_equal']) : ''; ?>" oninput="normalizeNumberInput(this)" placeholder="Ví dụ: 5">
                    </div>
                    <div class="field">
                        <label for="iso_base">
                            <i class="fas fa-ruler-combined"></i>
                            Cạnh đáy (b)
                        </label>
                        <input type="text" inputmode="decimal" name="iso_base" id="iso_base" value="<?php echo isset($_POST['iso_base']) ? h((string)$_POST['iso_base']) : ''; ?>" oninput="normalizeNumberInput(this)" placeholder="Ví dụ: 6">
                    </div>
                </div>
            </div>

            <div class="footer">
                <div class="actions">
                    <button type="submit">
                        <i class="fas fa-calculator"></i>
                        Tính
                    </button>
                    <button type="reset" class="secondary" onclick="onShapeChange('')">
                        <i class="fas fa-redo"></i>
                        Xóa & Làm lại
                    </button>
                </div>
                <?php if ($error): ?>
                    <div class="error"><?php echo h($error); ?></div>
                <?php elseif ($result !== null): ?>
                    <div class="result"><strong><?php echo h($resultLabel); ?> = <?php echo rtrim(rtrim(number_format($result, 6, '.', ''), '0'), '.'); ?> <?php echo $mode==='area' ? 'đơn vị²' : 'đơn vị'; ?></strong></div>
                <?php endif; ?>
            </div>
        </form>
    </div>
<?php
include("footer.php");
?>