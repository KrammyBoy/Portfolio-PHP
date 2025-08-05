<?php 

declare(strict_types= 1);
use App\Helper\LoginAlert;

$alert = LoginAlert::getLoginAlert();
if ($alert):
?>
<script>
    window.addEventListener('DOMContentLoaded', function(){
        showLoginAlert('<?= $alert['alert']?>', 4000);
    });
</script>
<?php endif; ?>