<?php
require_once 'Validator.php';
require_once 'Calculator.php';
require_once 'ResultRenderer.php';

/**
 * Module xử lý form và logic chính
 */
class FormHandler {
    private $a;
    private $b;
    private $operation;
    private $result_data;
    
    public function __construct() {
        $this->a = isset($_POST['a']) ? Validator::sanitizeInput($_POST['a']) : '';
        $this->b = isset($_POST['b']) ? Validator::sanitizeInput($_POST['b']) : '';
        $this->operation = isset($_POST['operation']) ? $_POST['operation'] : '';
        $this->result_data = [];
        
        $this->processForm();
    }
    
    /**
     * Xử lý logic chính của form
     */
    private function processForm() {
        if ($_POST && isset($_POST['calculate'])) {
            // Validate form
            $validation_error = Validator::validateForm($this->a, $this->b, $this->operation);
            if ($validation_error) {
                $this->result_data['error'] = $validation_error;
                return;
            }
            
            // Thực hiện tính toán
            try {
                $calculation = Calculator::calculate($this->operation, $this->a, $this->b);
                $this->result_data = ResultRenderer::createDetailedResult(
                    floatval($this->a),
                    $this->operation,
                    floatval($this->b),
                    $calculation['result'],
                    $calculation['operation_name']
                );
            } catch (Exception $e) {
                $this->result_data['error'] = $e->getMessage();
            }
        }
    }
    
    /**
     * Lấy giá trị a
     */
    public function getA() {
        return $this->a;
    }
    
    /**
     * Lấy giá trị b
     */
    public function getB() {
        return $this->b;
    }
    
    /**
     * Lấy phép toán được chọn
     */
    public function getOperation() {
        return $this->operation;
    }
    
    /**
     * Lấy dữ liệu kết quả
     */
    public function getResultData() {
        return $this->result_data;
    }
    
    /**
     * Kiểm tra xem có lỗi không
     */
    public function hasError() {
        return isset($this->result_data['error']);
    }
    
    /**
     * Kiểm tra xem có kết quả không
     */
    public function hasResult() {
        return isset($this->result_data['success']);
    }
}
?>
