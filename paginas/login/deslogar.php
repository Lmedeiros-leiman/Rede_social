<?php
include "../../essenciais/iniciar.php";


foreach ($_SESSION as $elemento => $valor) {
        $_SESSION[$elemento] = null;
        unset($_SESSION[$elemento]);
}
header("location: ../principal/index.php");
exit();