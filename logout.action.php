<?php

session_start();


session_unset('status');
session_unset('uid');
session_destroy();
unset($_SESSION);

echo "<script>window.location.href = 'index.php?op=login'</script>";
