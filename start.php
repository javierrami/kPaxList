<?php

/**
 * This plugin search inside, in order to find the best app to show you.
 * 
 * @javierrami
 *
 */

  elgg_register_event_handler('init', 'system', 'kpaxlist_init');


function kpaxlist_init(){

    elgg_extend_view('css/elgg', 'likes/css');
    elgg_extend_view('js/elgg', 'likes/js');

    // registered with priority < 500 so other plugins can remove likes
    //La verdad que no se para que esta esto.
    elgg_register_plugin_hook_handler('register', 'menu:river', 'likes_river_menu_setup', 400);
    elgg_register_plugin_hook_handler('register', 'menu:entity', 'likes_entity_menu_setup', 400);

    $root = dirname(__FILE__);

    $root = str_replace("kpaxlist", "kpax", $root);

//En teoria al estar ya la libreria registrada es necesario solo cargarla. Ya que el plugin se ejecuta después de kapax. 
	elgg_register_library('elgg:kpaxSrv', "$root/lib/kpaxSrv.php");
    elgg_load_library('elgg:kpaxSrv');

    //Registra como se procesa la pagina
    elgg_register_page_handler('kpaxlist', 'kpaxlist_page_handler');
    
  
  
  /* Esto forma parte del plugin antiguo
    $actions_base = elgg_get_plugins_path() . 'kpaxlist/actions/likes';

    elgg_register_action('kpaxlist/add', "$actions_base/add.php");
    elgg_register_action('kpaxlist/delete', "$actions_base/delete.php");
  
  

  
  //There we register the menus. 
    elgg_register_menu_item('site', array(
        'name' => 'kpaxlist',
        'text' => elgg_echo('kPAX:devs'),
        'href' => 'kpaxlist/list'
    ));
  */  
}

function kpaxlist_page_handler($page) {
  
    $pages = dirname(__FILE__) . '/pages';

    switch ($page[0]) {
        case "all":
            include "$pages/all.php";
            break;
        case "view":
        	include "$pages/view.php";
        	break;
        default:
            return false;
    }

    elgg_pop_context();

    return true;    
  
}
