<?php
    setcookie('session',1,time()-3600);
    setcookie('session_id',1,time()-3600);
    echo "<script>window.location= '../index.html' </script>";
?>
