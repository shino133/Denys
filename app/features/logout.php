<?php
if (isset($_SESSION['username'])) {
    session_unset();
    session_destroy();

    ?>
    <script>
        window.location = "'.$home_page.'";
    </script>
    <?php exit;

} else {
    ?>
    <script>
        window.location = "'.$home_page.'";
    </script>
    <?php exit;
}
?>