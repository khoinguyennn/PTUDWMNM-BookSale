<?php
include("header.php");
?>

    <div class="container">
        <h1>🔢 Kiểm tra số nguyên tố</h1>

        <!-- Form nhập số -->
        <div class="input-section">
            <form method="post" action="process.php">
                <div class="form-group">
                    <label for="number">Nhập số n:</label>
                    <input type="number" id="number" name="number" required min="2" placeholder="Ví dụ: 17">
                </div>
                <button type="submit">🔍 Kiểm tra</button>
            </form>
        </div>

        <!-- Hiển thị kết quả -->
        <?php
        if (isset($_GET['n'])) {
            $n = intval($_GET['n']);
            $is_prime = $_GET['is_prime'] === 'true';
            $primes = explode(',', $_GET['primes']);
            
            // Kiểm tra số nguyên tố
            echo '<div class="result-section">';
            if ($is_prime) {
                echo '<div class="result-prime">✅ Số <strong>' . $n . '</strong> là số nguyên tố! 🎉</div>';
            } else {
                echo '<div class="result-not-prime">❌ Số <strong>' . $n . '</strong> không phải là số nguyên tố 😔</div>';
            }
            echo '</div>';
            
            // Hiển thị các số nguyên tố từ 2 đến n
            echo '<div class="result-section">';
            echo '<div class="prime-title">🎯 Các số nguyên tố từ 2 đến ' . $n . ':</div>';
            echo '<div class="prime-container">';
            foreach ($primes as $prime) {
                if (!empty(trim($prime))) {
                    echo '<span class="prime-badge">' . trim($prime) . '</span>';
                }
            }
            echo '</div>';
            echo '<div class="prime-count">📊 Tổng cộng: <strong>' . count(array_filter($primes, 'trim')) . '</strong> số nguyên tố</div>';
            echo '</div>';
        }
        
        if (isset($_GET['error'])) {
            echo '<div class="result-section"><p>Số phải lớn hơn hoặc bằng 2.</p></div>';
        }
        ?>
    </div>



<?php
include("footer.php");
?>