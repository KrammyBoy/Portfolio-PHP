<?php 

declare (strict_types= 1);

use App\Helper\Toast;

$toast = Toast::getToast();

if ($toast):?>
<script>
    window.addEventListener('DOMContentLoaded', function (){
        showToast("<?= $toast['message']?>", "<?= $toast['type']?>", 3500)
    })
</script>
<?php endif; ?>