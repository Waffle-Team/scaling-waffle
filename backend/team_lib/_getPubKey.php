<?php


print(fread(fopen('publicKey.pem', "r"),filesize("publicKey.pem")));

?>
