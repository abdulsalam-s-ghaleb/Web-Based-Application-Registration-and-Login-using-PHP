<?php

if (isset($_SESSION['message'])) {
echo '
<div style="width: fit-content;margin: auto;top: 130px;box-shadow: 10px 10px 10px 6px rgb(0 0 0 / 40%);  z-index: 10;" class="alert alert-' . $_SESSION['type'] . '">
    <h6 style="text-align: center;">' . $_SESSION['message'] . '</h6>';
    unset($_SESSION['message']);
    unset( $_SESSION['type']);
    echo '
</div>';
}

?>
