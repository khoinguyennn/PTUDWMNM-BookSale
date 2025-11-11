<?php
/**
 * Module xử lý các phép toán cơ bản
 */
class Calculator {
    
    /**
     * Phép cộng
     */
    public static function add($a, $b) {
        return $a + $b;
    }
    
    /**
     * Phép trừ
     */
    public static function subtract($a, $b) {
        return $a - $b;
    }
    
    /**
     * Phép nhân
     */
    public static function multiply($a, $b) {
        return $a * $b;
    }
    
    /**
     * Phép chia
     */
    public static function divide($a, $b) {
        if ($b == 0) {
            throw new Exception('Không thể chia cho 0');
        }
        return $a / $b;
    }
    
    /**
     * Phép chia lấy dư
     */
    public static function modulo($a, $b) {
        if ($b == 0) {
            throw new Exception('Không thể chia cho 0');
        }
        return $a % $b;
    }
    
    /**
     * Thực hiện tính toán theo phép toán được chọn
     */
    public static function calculate($operation, $a, $b) {
        $num_a = floatval($a);
        $num_b = floatval($b);
        
        switch($operation) {
            case '+':
                return [
                    'result' => self::add($num_a, $num_b),
                    'operation_name' => 'cộng'
                ];
            case '-':
                return [
                    'result' => self::subtract($num_a, $num_b),
                    'operation_name' => 'trừ'
                ];
            case '*':
                return [
                    'result' => self::multiply($num_a, $num_b),
                    'operation_name' => 'nhân'
                ];
            case '/':
                return [
                    'result' => self::divide($num_a, $num_b),
                    'operation_name' => 'chia'
                ];
            case '%':
                return [
                    'result' => self::modulo($num_a, $num_b),
                    'operation_name' => 'chia lấy dư'
                ];
            default:
                throw new Exception('Phép toán không hợp lệ');
        }
    }
}
?>
