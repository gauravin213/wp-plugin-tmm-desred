<?php

defined( 'ABSPATH' ) || exit;

//my_wp_list_table_{table_name} like  tmm_desred_blood_donation  tmm-desred-blood-donation 



/*add_action( 'admin_menu', 'tmm_desred_blood_donation_admin_menu_page_fun');
function tmm_desred_blood_donation_admin_menu_page_fun(){


    $title = "desred sangh 222";
    $hook = add_menu_page( $title, $title, 'manage_options', 'tmm-desred-blood-donation', 'tmm_desred_blood_donation_admin_menu_fun');

    add_action( "load-$hook", 'tmm_desred_blood_donation_add_option');

}*/

function tmm_desred_blood_donation_admin_menu_fun(){

    global $wpdb;
?>  
<div class="wrap">

<?php
if ($_GET['action'] == 'add') {
        ?>
        <h2><?php _e( 'Add Blood Donor', 'tmm-desred-blood-donation-funds' ); ?></h2>
        <form id="form_tmm_desred_blood_donation" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="postbox-container-2" class="postbox-container">
                        <!--normal-->
                       <?php do_meta_boxes("tmm-desred-blood-donation-add-form", "normal", null); ?>
                    </div>
                    <div id="postbox-container-1" class="postbox-container">
                        <!--side-->
                        <?php do_meta_boxes("tmm-desred-blood-donation-submit-btn", "side", null); ?>
                    </div>
                </div>
                <br class="clear" />
            </div>
        </form>
        <?php
       
    }else if ($_GET['action'] == 'edit') {

        $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_blood_donation_tb WHERE ID=".$_GET['customer']);
       
        ?>
        <h1 class="wp-heading-inline"><?php _e( 'Edit Blood Donor Detail', 'tmm-desred-blood-donation-funds' ); ?></h1>
        <a href="<?php echo admin_url();?>admin.php?page=tmm-desred-blood-donation&action=add" class="page-title-action">
            <?php _e( 'Add New', 'tmm-desred-blood-donation-funds' ); ?></a>
        <hr class="wp-header-end">
        <form id="form_tmm_desred_blood_donation" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="postbox-container-2" class="postbox-container">
                        <!--normal-->
                       <?php do_meta_boxes("tmm-desred-blood-donation-edit-form", "normal", $result); ?>
                    </div>
                    <div id="postbox-container-1" class="postbox-container">
                        <!--side-->
                        <?php do_meta_boxes("tmm-desred-blood-donation-submit-btn", "side", $result); ?>
                    </div>
                </div>
                <br class="clear" />
            </div>
        </form>
        <?php

       
    }else{

        $exampleListTable = new TmmDesredBloodDoonation();
        ?>
        <h1 class="wp-heading-inline"><?php _e( 'Blood Donors', 'tmm-desred-blood-donation-funds' ); ?></h1>
        <a href="<?php echo admin_url();?>admin.php?page=tmm-desred-blood-donation&action=add" class="page-title-action"><?php _e( 'Add New', 'tmm-desred-blood-donation-funds' ); ?></a>
        <a href="<?php echo admin_url( 'admin-post.php?action=TmmDesredExportData&tb_name=tmm_blood_donation_tb' ); ?>" class="page-title-action">Export</a>
        <hr class="wp-header-end">
        <form id="tmm_desred_blood_donation_form" method="get">
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <?php
            $exampleListTable->prepare_items();
            $exampleListTable->views();
            $exampleListTable->search_box("Search Post(s)", "search_post_id");
            $exampleListTable->display(); 
            ?>
        </form>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('#name_filter').select2({placeholder : "select me" });
                jQuery('#city_filter').select2({placeholder : "select me" });
            });
        </script>
        <?php

    }
?>
       
</div>
<div class="clear"></div>
<script type="text/javascript">
jQuery(document).ready(function($){
    jQuery(".if-js-closed").removeClass("if-js-closed").addClass("closed");
    postboxes.add_postbox_toggles( pagenow );
});
</script>
<?php
}

function tmm_desred_blood_donation_edit_form_fun($result){

    $lm_number = $result[0]->lm_number;
    $date_of_blood_donation = $result[0]->date_of_blood_donation;
    $note = $result[0]->note;

   ?>
    <div class="form_field">
        <label><strong><?php _e( 'Lm number', 'tmm-desred-blood-donation-funds' ); ?></strong></label>
        <?php
        $lm_number = !empty( $lm_number ) ? $lm_number : '';
        $name = 'lm_number';
        $get_member = get_member($name, $lm_number);
        ?>
        <label for="lm_number" class="error"></label>
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Date', 'tmm-desred-blood-donation-funds' ); ?></strong></label>
        <input type="text" name="date_of_blood_donation" placeholder="Date of blood donation" value="<?php echo $date_of_blood_donation?>" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Note', 'tmm-desred-sangh-funds' ); ?></strong></label>
        <input type="text" name="note" placeholder="add description(if any)" value="<?php echo $note?>" class="large-text"> 
    </div>

    <input type="hidden" name="customer" value="<?php echo $_GET['customer'];?>">

    <input type="hidden" name="mode" value="edit">

    <input type="hidden" name="action" value="tmm_desred_blood_donation_Form_Action">
   <?php

}

function tmm_desred_blood_donation_submit_btn_fun(){
    ?>
    <button name="btn_smt" class="button button-primary button-large">Submit</button>
    <?php
}


function tmm_desred_blood_donation_add_form_fun(){

    ?>
    <div class="form_field">
        <label><strong><?php _e( 'Lm number', 'tmm-desred-blood-donation-funds' ); ?></strong></label>
        <?php
        $lm_number = !empty( $lm_number ) ? $lm_number : '';
        $name = 'lm_number';
        $get_member = get_member($name, $lm_number);
        ?>
        <label for="lm_number" class="error"></label>
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Date', 'tmm-desred-blood-donation-funds' ); ?></strong></label>
        <input type="text" name="date_of_blood_donation" placeholder="Date of blood donation" value="" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Note', 'tmm-desred-blood-donation-funds' ); ?></strong></label>
        <input type="text" name="note" placeholder="add description(if any)" value="" class="large-text"> 
    </div>

    <input type="hidden" name="action" value="tmm_desred_blood_donation_Form_Action">

    <input type="hidden" name="mode" value="add">
    <?php
}

function tmm_desred_blood_donation_add_option() {

    add_meta_box("tmm-desred-blood-donation-edit-form", "Member", "tmm_desred_blood_donation_edit_form_fun", "tmm-desred-blood-donation-edit-form", "normal");

    add_meta_box("tmm-desred-blood-donation-add-form", "Member", "tmm_desred_blood_donation_add_form_fun", "tmm-desred-blood-donation-add-form", "normal");

    add_meta_box("tmm-desred-blood-donation-submit-btn", "Publish", "tmm_desred_blood_donation_submit_btn_fun", "tmm-desred-blood-donation-submit-btn", "side");

    $option = 'per_page';
 
	$args = array(
	    'label' => 'Customer',
	    'default' => 10,
	    'option' => 'customer_list_per_page'
	);
	 
	add_screen_option( $option, $args );

    $exampleListTable = new TmmDesredBloodDoonation();


}


add_filter('set-screen-option', 'tmm_desred_blood_donation_set_option', 10, 3);
 
function tmm_desred_blood_donation_set_option($status, $option, $value) {
 
    if ( 'customer_list_per_page' == $option ) return $value;
 
    return $status;
 
}


add_action('admin_post_tmm_desred_blood_donation_Form_Action', 'tmm_desred_blood_donation_Form_Action');
add_action('admin_post_nopriv_tmm_desred_blood_donation_Form_Action', 'tmm_desred_blood_donation_Form_Action');
function tmm_desred_blood_donation_Form_Action(){

    global $wpdb;

    if ($_POST['mode'] == 'add') { 

        $wpdb->insert( 
            "{$wpdb->prefix}tmm_blood_donation_tb", 
            array( 
                'lm_number' => $_POST['lm_number'],
                'date_of_blood_donation' => $_POST['date_of_blood_donation'],
                'note' => $_POST['note'],
                'status' => 'publish'
                ), 
            array( 
                '%s',   
                '%s',
                '%s',
                '%s'     
            )
        ); 


        $lastid = $wpdb->insert_id;  


        if($wpdb->last_error !== '') { 

            $_SESSION['add_error_message_session'] = $wpdb->last_error;
            $redirect_url = admin_url().'admin.php?page=tmm-desred-blood-donation&action=add';
            wp_redirect($redirect_url);
            die();

        }else{

            $_SESSION['add_message_session'] = 'Save successfully';
            
        }


    }  


    if ($_POST['mode'] == 'edit') {

        $wpdb->update( 
            "{$wpdb->prefix}tmm_blood_donation_tb", 
            array( 
                'lm_number' => $_POST['lm_number'],
                'date_of_blood_donation' => $_POST['date_of_blood_donation'],
                'note' => $_POST['note'],
            ), 
            array( 'ID' => $_POST['customer'] ), 
            array( 
                '%s',   
                '%s',
                '%s' 
            ), 
            array( '%d' ) 
        );

        $lastid = $_POST['customer'];


        if($wpdb->last_error !== '') { 

            $_SESSION['add_error_message_session'] = $wpdb->last_error;

            $redirect_url = admin_url().'admin.php?page=tmm-desred-blood-donation&action=edit&customer='.$lastid;
            wp_redirect($redirect_url);
            die();

        }else{

           $_SESSION['edit_message_session'] = 'Updated successfully';
            
        }

    }

    $delete_nonce = wp_create_nonce( 'sp_delete_customer' );
    
    $redirect_url = admin_url().'admin.php?page=tmm-desred-blood-donation&action=edit&customer='.$lastid;
    wp_redirect($redirect_url);
    die();
}

function tmm_desred_blood_donation_admin_notice__success() {

  $screen = get_current_screen();

  //if ( $screen->id !== 'toplevel_page_tmm-desred-blood-donation') return;

    if (isset($_SESSION["add_message_session"])) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e( $_SESSION['add_message_session'], 'tmm-desred-blood-donation-funds' ); ?></p>
        </div>
        <?php
        if (basename($_SERVER['PHP_SELF']) != $_SESSION["add_message_session"]) {
            unset($_SESSION['add_message_session']);
        }
    }


    if (isset($_SESSION["edit_message_session"])) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e( $_SESSION['edit_message_session'], 'tmm-desred-blood-donation-funds' ); ?></p>
        </div>
        <?php
        if (basename($_SERVER['PHP_SELF']) != $_SESSION["edit_message_session"]) {
            unset($_SESSION['edit_message_session']);
        }
    }

    if (isset($_SESSION["add_error_message_session"])) {
        ?>
        <div class="notice notice-error is-dismissible">
            <p><?php _e( $_SESSION['add_error_message_session'], 'tmm-desred-blood-donation-funds' ); ?></p>
        </div>
        <?php
        if (basename($_SERVER['PHP_SELF']) != $_SESSION["add_error_message_session"]) {
            unset($_SESSION['add_error_message_session']);
        }
    }

}
add_action( 'admin_notices', 'tmm_desred_blood_donation_admin_notice__success' );