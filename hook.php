<?php

function plugin_workshop_install()
{
    set_time_limit(900);
    ini_set('memory_limit', '2048M');

    $classesToInstall = [
       'PluginWorkshopMember',
    ];

    echo "<center>";
    echo "<table class='tab_cadre_fixe'>";
    echo "<tr><th>".__("MySQL tables installation", "workshop")."<th></tr>";

    echo "<tr class='tab_bg_1'>";
    echo "<td align='center'>";

    //load all classes
    $dir  = Plugin::getPhpDir('workshop') . "/inc/";
    foreach ($classesToInstall as $class) {
        if ($plug = isPluginItemType($class)) {
            $item = strtolower($plug['class']);
            if (file_exists("$dir$item.class.php")) {
                include_once("$dir$item.class.php");
            }
        }
    }

    //install
    foreach ($classesToInstall as $class) {
        if ($plug = isPluginItemType($class)) {
            $item = strtolower($plug['class']);
            if (file_exists("$dir$item.class.php")) {
                if (!call_user_func([$class,'install'])) {
                    return false;
                }
            }
        }
    }

    echo "</td>";
    echo "</tr>";
    echo "</table></center>";

    return true;
}

function plugin_workshop_uninstall()
{
    echo "<center>";
    echo "<table class='tab_cadre_fixe'>";
    echo "<tr><th>".__("MySQL tables uninstallation", "fields")."<th></tr>";

    echo "<tr class='tab_bg_1'>";
    echo "<td align='center'>";

    $classesToUninstall = [
       'PluginWorkshopMember',
    ];

    foreach ($classesToUninstall as $class) {
        if ($plug = isPluginItemType($class)) {

            $dir  = Plugin::getPhpDir('workshop') . "/inc/";
            $item = strtolower($plug['class']);

            if (file_exists("$dir$item.class.php")) {
                include_once("$dir$item.class.php");
                if (!call_user_func([$class,'uninstall'])) {
                    return false;
                }
            }
        }
    }

    echo "</td>";
    echo "</tr>";
    echo "</table></center>";

    return true;
}
