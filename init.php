<?php

define('DS', DIRECTORY_SEPARATOR);

//menu items
add_action('admin_menu','NK_schools_modifymenu');
function NK_schools_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page('Klasy', //page title
            'Klasy', //menu title
            'manage_options', //capabilities
            'NK_class_list', //menu slug
            'NK_class_list' //function
	);
	
	//this is a submenu
	add_submenu_page('NK_class_list', //parent slug
            'Dodaj nową klasę', //page title
            'Dodaj nową', //menu title
            'manage_options', //capability
            'NK_class_create', //menu slug
            'NK_class_create'//function
        ); 
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
            'Popraw Klasę', //page title
            'Popraw', //menu title
            'manage_options', //capability
            'NK_class_update', //menu slug
            'NK_class_update'//function
        ); 
        
        add_menu_page( //parent slug
            'Plan zajęć', //page title
            'Plan zajęć', //menu title
            'manage_options', //capability
            'NK_schools_scheduler', //menu slug
            'NK_schools_scheduler'//function
        );
        
        add_menu_page( //parent slug
            'Nauczyciele', //page title
            'Nauczyciele', //menu title
            'manage_options', //capability
            'NK_teacher_list', //menu slug
            'NK_teacher_list'//function
        );
        
        //this is a submenu
	add_submenu_page('NK_teacher_list', //parent slug
            'Dodaj nowego Nauczyciela', //page title
            'Dodaj nowego', //menu title
            'manage_options', //capability
            'NK_teacher_create', //menu slug
            'NK_teacher_create'//function
        ); 
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
            'Popraw Nauczyciela', //page title
            'Popraw', //menu title
            'manage_options', //capability
            'NK_teacher_update', //menu slug
            'NK_teacher_update'//function
        ); 
        
        add_menu_page( //parent slug
            'Przedmioty', //page title
            'Przedmioty', //menu title
            'manage_options', //capability
            'NK_subject_list', //menu slug
            'NK_subject_list'//function
        );
        
        //this is a submenu
	add_submenu_page('NK_subject_list', //parent slug
            'Dodaj nowego Nauczyciela', //page title
            'Dodaj nowego', //menu title
            'manage_options', //capability
            'NK_subject_create', //menu slug
            'NK_subject_create'//function
        ); 
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
            'Popraw Nauczyciela', //page title
            'Popraw', //menu title
            'manage_options', //capability
            'NK_subject_update', //menu slug
            'NK_subject_update'//function
        ); 
}
define('ROOTDIR', plugin_dir_path(__FILE__));
$class     = 'class';
$teacher   = 'teacher';
$scheduler = 'scheduler';
$subject   = 'subject';
require_once(ROOTDIR . DS .$class. DS .$class. '-list.php');
require_once(ROOTDIR . DS .$class. DS .$class. '-create.php');
require_once(ROOTDIR . DS .$class. DS .$class. '-update.php');

require_once(ROOTDIR . DS .$teacher. DS . $teacher. '-list.php');
require_once(ROOTDIR . DS .$teacher. DS . $teacher. '-create.php');
require_once(ROOTDIR . DS .$teacher. DS . $teacher. '-update.php');

require_once(ROOTDIR . DS .$subject. DS . $subject. '-list.php');
require_once(ROOTDIR . DS .$subject. DS . $subject. '-create.php');
require_once(ROOTDIR . DS .$subject. DS . $subject. '-update.php');

require_once(ROOTDIR . DS .$scheduler. DS . 'class-scheduler.php');
///require_once(ROOTDIR . DS .$scheduler. DS . 'teacher-update.php');