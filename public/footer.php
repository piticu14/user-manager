<?php

use App\Errors;

if (Errors::exist()) :
    foreach (Errors::get() as $error): ?>
        <p class="error"><?= $error ?></p>
    <?php endforeach;
endif;

include_once("footer.php"); ?>

</div>
<div class="footer">
    <p>Cudelcu Valentin Emil</p>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="js/script.js"></script>
<script>
    /**
     * Pokud je uzivatel online,
     * aktualizuj jeho aktivni stav kazdou minutu
     */
    <?php
    use App\Session;
    if (Session::exist('id')) :
    ?>
    setInterval(function () {
        update_user_activity();
    }, 60 * 1000);
    <?php endif; ?>
</script>
</html>