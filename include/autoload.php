<?php

spl_autoload_register("autoloadMachine");
function autoloadMachine($classname)
{
    $path = 'Component\\';
    $realPath = $path . $classname . ".php";
    if (!file_exists($realPath)) {
        return 'false';
    }
    require_once $path . $classname . ".php";
}
