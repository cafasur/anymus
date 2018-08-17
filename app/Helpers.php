<?php



if (! function_exists('menu_apps')) {
    function menu_apps($user) {
        $applications = \App\Application::all();
        return $applications;
    }
}

if (! function_exists('app_menu_item')) {
    function app_menu_item($user, $idApp) {
        $menuItems = \App\MenuItem::where('application_id', '=', $idApp)->get();
        return $menuItems;
    }
}