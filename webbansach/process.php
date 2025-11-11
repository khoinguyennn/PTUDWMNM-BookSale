<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $n = intval($_POST['number']);

    if ($n < 2) {
        header("Location: index.php?error=invalid");
        exit();
    }

    // Kiểm tra số nguyên tố
    $is_prime = is_prime($n);

    // Tìm tất cả số nguyên tố từ 2 đến n
    $primes = get_primes_up_to($n);
    $primes_str = implode(',', $primes);

    // Redirect về trang HTML với kết quả
    $result = $is_prime ? 'true' : 'false';
    header("Location: index.php?n=$n&is_prime=$result&primes=$primes_str");
    exit();
}

function is_prime($num) {
    if ($num <= 1) return false;
    if ($num <= 3) return true;
    if ($num % 2 == 0 || $num % 3 == 0) return false;
    for ($i = 5; $i * $i <= $num; $i += 6) {
        if ($num % $i == 0 || $num % ($i + 2) == 0) return false;
    }
    return true;
}

function get_primes_up_to($n) {
    $primes = [];
    for ($i = 2; $i <= $n; $i++) {
        if (is_prime($i)) {
            $primes[] = $i;
        }
    }
    return $primes;
}
?>