<?php
session_start();// Zapneme session
session_destroy();// Sma�eme v�echna session 'login'
?>
<script>
    window.location.href="../index.html";
</script> 
<?php
die();
?>