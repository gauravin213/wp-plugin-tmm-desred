<?php

/*
Plugin Name: Tmm DESRED
Description: This is the Diploma Engineer Sangh Rural Engineering Department plugin
Author: Dev
Text Domain: tmm-desred
*/

//prefix: TmmDesred

defined( 'ABSPATH' ) or die();

define( 'TmmDesred_VERSION', '1.0.0' );
define( 'TmmDesred_URL', plugin_dir_url( __FILE__ ) );
define( 'TmmDesred_PATH', plugin_dir_path( __FILE__ ) );

require_once 'Activate.php';
require_once 'Deactivate.php';
require_once 'includes/TmmDesred-function.php';

if ( ! class_exists( 'TmmDesred' ) ) {

    /**
     * Class AuctionProperty
     */
    final class TmmDesred {

        public function activate() {
            Activate::activate();
        }

        public function deactivate() {
            Deactivate::deactivate();
        }

    }

}

if ( class_exists( 'TmmDesred' ) ) {

    $auction = new TmmDesred();
    register_activation_hook( __FILE__, [ $auction, 'activate' ] );
    register_deactivation_hook( __FILE__, [ $auction, 'deactivate' ] );

}


add_action( 'wp_ajax_my_level_action', 'my_level_action_fun');
add_action( 'wp_ajax_nopriv_my_level_action', 'my_level_action_fun');
function my_level_action_fun(){

    global $wpdb;

    $lm_number = $_POST['lm_number'];

    $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_family_welfare_scheme_tb WHERE lm_number=".$lm_number);
    
    $count = count($result);

    $myArr = array(
        'response' => $result,
        'lm_number' => $lm_number,
        'count' => $count
    );
    $myJSON = json_encode($myArr); 
    echo $myJSON;
    die();
}


add_action( 'wp_ajax_my_level_action2', 'my_level_action2_fun');
add_action( 'wp_ajax_nopriv_my_level_action2', 'my_level_action2_fun');
function my_level_action2_fun(){

    global $wpdb;

    $lm_number = $_POST['lm_number'];

    $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_family_welfare_scheme_mahasangh_tb WHERE lm_number=".$lm_number);
    
    $count = count($result);

    $myArr = array(
        'response' => $result,
        'lm_number' => $lm_number,
        'count' => $count,
        'ppppp' => 'pppp'
    );  
    $myJSON = json_encode($myArr); 
    echo $myJSON;
    die();
}


add_action( 'wp_ajax_cart_Of_sameLevel_action', 'cart_Of_sameLevel_action_fun');
add_action( 'wp_ajax_nopriv_cart_Of_sameLevel_action', 'cart_Of_sameLevel_action_fun');
function cart_Of_sameLevel_action_fun(){

    global $wpdb;

    $lm_number = $_POST['lm_number'];

    $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_family_welfare_scheme_mahasangh_tb WHERE lm_number=".$lm_number);
    
    $count = count($result);

    $myArr = array(
        'response' => $result,
        'card_number' => $result[0]->card_number,
    );  
    $myJSON = json_encode($myArr); 
    echo $myJSON;
    die();
}



add_action( 'wp_ajax_card_number_check_action', 'card_number_check_action_fun');
add_action( 'wp_ajax_nopriv_card_number_check_action', 'card_number_check_action_fun');
function card_number_check_action_fun(){

    global $wpdb;

    $card_number = $_POST['card_number'];

    $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_family_welfare_scheme_mahasangh_tb WHERE card_number=".$card_number);
    
    $count = count($result);

    if ($count != 0) {
        $status = 'cart_no_exist';
    }else{
        $status = 'cart_no_not_exist';
    }

    $myArr = array(
        'count' => $count,
        'status' => $status
    );  
    $myJSON = json_encode($myArr); 
    echo $myJSON;
    die();
}


add_action( 'wp_ajax_card_number_check_sangh_action', 'card_number_check_sangh_action_fun');
add_action( 'wp_ajax_nopriv_card_number_check_sangh_action', 'card_number_check_sangh_action_fun');
function card_number_check_sangh_action_fun(){

    global $wpdb;

    $card_number = $_POST['card_number'];

    $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_family_welfare_scheme_tb WHERE card_number=".$card_number);
    
    $count = count($result);

    if ($count != 0) {
        $status = 'cart_no_exist';
    }else{
        $status = 'cart_no_not_exist';
    }

    $myArr = array(
        'count' => $count,
        'status' => $status
    );  
    $myJSON = json_encode($myArr); 
    echo $myJSON;
    die();
}