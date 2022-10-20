<?php
  $publicKey = "cert.cer";
  $plaintext = "Microsoft!5";
  
    openssl_public_encrypt($plaintext, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING);
    
    echo base64_encode($encrypted);
      
?>
