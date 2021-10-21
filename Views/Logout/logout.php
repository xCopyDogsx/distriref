<?php
include('Config/GoogleConf.php');
$google_client->revokeToken();
session_destroy();
?>
<html>
 <body>
    <script>
         window.location.href = "<?=BASE_URL?>";
        </script>
  <script src="https://apis.google.com/js/platform.js" async defer></script>
 </body>
</html>