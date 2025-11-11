<?php
include("header.php");
?>
    <div class="container">
        <h1>Danh sách số chẵn</h1>
        <form method="post" action="">
            <label for="number">Nhập một số nguyên dương:</label>
            <div class="field-row">
                <input type="number" id="number" name="number" min="2" placeholder="Ví dụ: 50" value="<?php echo isset($_POST['number']) ? htmlspecialchars($_POST['number']) : ''; ?>" required>
                <button type="submit">Xuất</button>
            </div>
            <div class="actions">
                <button type="button" class="btn-secondary" onclick="document.getElementById('number').value=''; document.getElementById('results').innerHTML='';">Reset</button>
            </div>
        </form>

        <div id="results">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $number = intval($_POST['number']);

            if ($number < 2) {
                echo '<div class="error"><span>Vui lòng nhập một số lớn hơn hoặc bằng 2.</span></div>';
            } else {
                echo '<div class="results">';
                echo '<p class="results-title">Các số chẵn từ 2 đến '.htmlspecialchars($number).':</p>';
                echo '<div class="badges">';
                for ($i = 2; $i <= $number; $i += 2) {
                    echo '<span class="badge">'.$i.'</span>';
                }
                echo '</div></div>';
            }
        }
        ?>
        </div>
        <!-- <footer>&copy; '.date('Y').' Demo Simple PHP</footer> -->
    </div>
<?php
include("footer.php");
?>