<?php

function Redirect($url) {
    flush(); // Flush the buffer
    ob_flush();
    header("Location: $url", true, 301); // Rewrite the header
    exit;
}

?>