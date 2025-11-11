
    <?php
include("header.php");
    ?>
    <div class="container">
        <h1>Danh sách số nguyên dương lẻ</h1>
        <p class="subtitle">Nhập một số n và hệ thống sẽ liệt kê các số lẻ từ 1 đến n.</p>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="number">Nhập một số nguyên dương:</label>
                <input type="number" id="number" name="number" min="1" 
                       value="<?php echo isset($_POST['number']) ? htmlspecialchars($_POST['number']) : ''; ?>" 
                       required>
            </div>
            <div class="actions">
                <button type="submit" class="btn btn-primary">Tìm các số lẻ</button>
                <a class="btn btn-ghost" href="index.php" aria-label="Làm mới trang">Làm mới</a>
            </div>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['number'])) {
            $input_number = $_POST['number'];
            
            // Kiểm tra tính hợp lệ của đầu vào
            if (!is_numeric($input_number) || $input_number < 1 || $input_number != (int)$input_number) {
                echo '<div class="result error">';
                echo '<h3>Lỗi!</h3>';
                echo '<p>Vui lòng nhập một số nguyên dương hợp lệ (≥ 1).</p>';
                echo '</div>';
            } else {
                $number = (int)$input_number;
                
                echo '<div class="result">';
                echo '<p>Các số nguyên dương lẻ từ 1 đến ' . $number . ' là:</p>';
                
                // Tìm và hiển thị các số lẻ
                $odd_numbers = array();
                for ($i = 1; $i <= $number; $i++) {
                    if ($i % 2 == 1) { // Kiểm tra số lẻ
                        $odd_numbers[] = $i;
                    }
                }
                if (!empty($odd_numbers)) {
                    echo '<div class="odd-numbers">';
                    foreach ($odd_numbers as $odd) {
                        echo '<span class="odd-number">' . $odd . '</span>';
                    }
                    echo '</div>';
                } else {
                    echo '<p>Không có số lẻ nào trong khoảng này.</p>';
                }
                echo '</div>';
            }
        }
        ?>
    </div>
<?php
include("footer.php");
    ?>
