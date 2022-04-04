<?php
session_start();// Zapneme session
session_destroy();// Smažeme všechna session 'login'
?>
<script>
    window.location.href="../index.html";
</script> 
<?php
die();
?>