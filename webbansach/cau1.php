<?php
include("header.php");
?>
<?php
/**
 * Chương trình máy tính sử dụng kiến trúc module
 * Nhóm: Câu 1 - DA22TTB
 */

// Import các module cần thiết
require_once 'modules/FormHandler.php';
require_once 'modules/ResultRenderer.php';

// Khởi tạo form handler
$formHandler = new FormHandler();
?>
    <div class="math-background">
        <span>1</span><span>2</span><span>3</span><span>+</span><span>-</span><span>×</span><span>÷</span><span>=</span>
        <span>4</span><span>5</span><span>6</span><span>%</span><span>π</span><span>√</span><span>²</span><span>³</span>
        <span>7</span><span>8</span><span>9</span><span>∞</span><span>∑</span><span>∆</span><span>∫</span><span>∂</span>
        <span>0</span><span>.</span><span>,</span><span>≠</span><span>≤</span><span>≥</span><span>±</span><span>≈</span>
    </div>
    <div class="calculator">
        <div class="title">Chương trình máy tính</div>
        
        <form method="POST" action="">
            <div class="input-container">
                <div class="input-row">
                    <div class="input-label">Nhập a:</div>
                    <input type="text" class="input-field" name="a" value="<?php echo htmlspecialchars($formHandler->getA()); ?>" placeholder="Nhập số a">
                </div>
                <div class="input-row">
                    <div class="input-label">Nhập b:</div>
                    <input type="text" class="input-field" name="b" value="<?php echo htmlspecialchars($formHandler->getB()); ?>" placeholder="Nhập số b">
                </div>
            </div>
            
            <div class="operation-section">
                <div class="operation-title">Chọn phép toán</div>
                <div class="button-group">
                    <button type="submit" name="operation" value="+" class="calc-button <?php echo ($formHandler->getOperation() == '+') ? 'selected' : ''; ?>" title="Cộng">+</button>
                    <button type="submit" name="operation" value="-" class="calc-button <?php echo ($formHandler->getOperation() == '-') ? 'selected' : ''; ?>" title="Trừ">-</button>
                    <button type="submit" name="operation" value="*" class="calc-button <?php echo ($formHandler->getOperation() == '*') ? 'selected' : ''; ?>" title="Nhân">*</button>
                    <button type="submit" name="operation" value="/" class="calc-button <?php echo ($formHandler->getOperation() == '/') ? 'selected' : ''; ?>" title="Chia">/</button>
                    <button type="submit" name="operation" value="%" class="calc-button <?php echo ($formHandler->getOperation() == '%') ? 'selected' : ''; ?>" title="Chia lấy dư">%</button>
                </div>
                <input type="hidden" name="calculate" value="1">
            </div>
            
            <div class="result-container">
                <div class="result-row">
                    <div class="result-label">Kết quả:</div>
                    <div class="result-field">
                        <?php echo ResultRenderer::renderResult($formHandler->getResultData()); ?>
                    </div>
                </div>
            </div>
        </form>
        
        <!-- <div class="info-section">
            <strong>Nhóm:</strong> Câu 1 - DA22TTB<br>
            <strong>Thành viên:</strong> Trầm Khôi Nguyên, Trần Thị Yến Nhi, Nguyễn Duy Phát, Sơn Ngọc Tân, Nguyễn Đình Nhật Huy
        </div> -->
    </div>

<?php
include("footer.php");
?>
