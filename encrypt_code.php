<?php
//PREPRATION
function encrypt($code,$password)
{
    $simple_string = $code;
    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options   = 0;
    $encryption_iv = '1234567891011121';
    $encryption_key = $password;
    $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
    echo $encryption;
}
function secure_code()
{
    $file_name = $_GET['file'];
    $code = file_get_contents($file_name);
    encrypt(base64_encode($code),'123456');
}


//PREPRATION


//DEPLOY
function decrypt($cypher,$password)
{
    $encryption = $cypher;
    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options   = 0;
    $encryption_iv = '1234567891011121';
    $decryption_key = $password;
    $decryption = openssl_decrypt($encryption, $ciphering, $decryption_key, $options, $encryption_iv);
    $code = base64_decode($decryption);
    eval("$code");
}
//secure_code();
$code = 'ENCRYPTED CODE';
decrypt($code,$_GET['password']);
//DEPLOY
?>
