<?php

/**
 * Dump and die.
 *
 * @param $var
 * @return void
 */
function dd(...$var) {
    foreach ($var as $elem) {
        echo '<pre class="codespan">';
        echo '<code>';
        !$elem || $elem == '' ? var_dump($elem) : print_r($elem);
        echo '</code>';
        echo '</pre>';
    }

    die();
}
