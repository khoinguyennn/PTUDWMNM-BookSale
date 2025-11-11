<?php
/**
 * Module validation và xử lý input
 */
class Validator {
    
    /**
     * Kiểm tra tính hợp lệ của input
     */
    public static function validateInput($a, $b) {
        $errors = [];
        
        // Kiểm tra input rỗng
        if ($a === '' || $b === '') {
            $errors[] = 'Vui lòng nhập đầy đủ hai số';
            return $errors;
        }
        
        // Kiểm tra input có phải số không
        if (!is_numeric($a) || !is_numeric($b)) {
            $errors[] = 'Vui lòng nhập số hợp lệ';
            return $errors;
        }
        
        return $errors;
    }
    
    /**
     * Kiểm tra tính hợp lệ của phép toán
     */
    public static function validateOperation($operation) {
        $valid_operations = ['+', '-', '*', '/', '%'];
        
        if (!in_array($operation, $valid_operations)) {
            return ['Vui lòng chọn phép toán'];
        }
        
        return [];
    }
    
    /**
     * Làm sạch input để tránh XSS
     */
    public static function sanitizeInput($input) {
        return htmlspecialchars(trim($input));
    }
    
    /**
     * Kiểm tra toàn bộ form
     */
    public static function validateForm($a, $b, $operation) {
        // Kiểm tra input
        $input_errors = self::validateInput($a, $b);
        if (!empty($input_errors)) {
            return $input_errors[0];
        }
        
        // Kiểm tra phép toán
        $operation_errors = self::validateOperation($operation);
        if (!empty($operation_errors)) {
            return $operation_errors[0];
        }
        
        return null;
    }
}
?>
