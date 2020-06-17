<?php

defined( 'ABSPATH' ) || exit;

//my_wp_list_table_{table_name} like  tmm_desred_expenses  tmm-desred-expenses  

/*add_action( 'admin_menu', 'tmm_desred_expenses_admin_menu_page_fun');
function tmm_desred_expenses_admin_menu_page_fun(){

    $title = "desred sangh";
    $hook = add_menu_page( $title, $title, 'manage_options', 'tmm-desred-expenses', 'tmm_desred_expenses_admin_menu_fun');

    add_action( "load-$hook", 'tmm_desred_expenses_add_option');

}*/

function tmm_desred_expenses_admin_menu_fun(){
?>  
<div class="wrap">
        <?php
            global $wpdb;

            if ($_GET['action'] == 'add') {
                ?>
                <h2><?php _e( 'Add Expenses', 'tmm-desred-expenses-funds' ); ?></h2>
                <form id="form_tmm_desred_expenses_add_option" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <div id="poststuff">
                        <div id="post-body" class="metabox-holder columns-2">
                            <div id="postbox-container-2" class="postbox-container">
                                <!--normal-->
                               <?php do_meta_boxes("tmm-desred-expenses-add-form", "normal", null); ?>
                            </div>
                            <div id="postbox-container-1" class="postbox-container">
                                <!--side-->
                                <?php do_meta_boxes("tmm-desred-expenses-side", "side", null); ?>
                            </div>
                        </div>
                        <br class="clear" />
                    </div>
                </form>
                <?php
               
            }else if ($_GET['action'] == 'edit') {

                $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_expenses_tb WHERE ID=".$_GET['customer']);
               
                ?>
                <h1 class="wp-heading-inline"><?php _e( 'Edit Expenses', 'tmm-desred-expenses-funds' ); ?></h1>
                <a href="<?php echo admin_url();?>admin.php?page=tmm-desred-expenses&action=add" class="page-title-action">
                    <?php _e( 'Add New', 'tmm-desred-expenses-funds' ); ?></a>
                <hr class="wp-header-end">
                <form id="form_tmm_desred_expenses_add_option" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <div id="poststuff">
                        <div id="post-body" class="metabox-holder columns-2">
                            <div id="postbox-container-2" class="postbox-container">
                                <!--normal-->
                               <?php do_meta_boxes("tmm-desred-expenses-edit-form", "normal", $result); ?>
                            </div>
                            <div id="postbox-container-1" class="postbox-container">
                                <!--side-->
                                <?php do_meta_boxes("tmm-desred-expenses-side", "side", $result); ?>
                            </div>
                        </div>
                        <br class="clear" />
                    </div>
                </form>
                <?php

               
            }else{

                $exampleListTable = new TmmDesredExpenses();
                ?>
                <h1 class="wp-heading-inline"><?php _e( 'Expenses', 'tmm-desred-expenses-funds' ); ?></h1>
                <a href="<?php echo admin_url();?>admin.php?page=tmm-desred-expenses&action=add" class="page-title-action"><?php _e( 'Add New', 'tmm-desred-expenses-funds' ); ?></a>
                <hr class="wp-header-end">
                <form id="tmm_desred_expenses_form" method="get">
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

function tmm_desred_expenses_edit_form_fun($result){

    $department = $result[0]->department;
    $causes = $result[0]->causes;
    $amount = $result[0]->amount;
    $year = $result[0]->year;

   ?>

    <div class="form_field">
        <label><strong><?php _e( 'Department', 'tmm-desred-expenses-funds' ); ?></strong></label>
        <input type="text" name="department" placeholder="department" value="<?php echo $department?>" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Causes', 'tmm-desred-expenses-funds' ); ?></strong></label>
        <input type="text" name="causes" placeholder="causes" value="<?php echo $causes?>" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Amount', 'tmm-desred-expenses-funds' ); ?></strong></label>
        <input type="text" name="amount" placeholder="amount" value="<?php echo $amount?>" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Year', 'tmm-desred-expenses-funds' ); ?></strong></label>
        <input type="text" name="year" placeholder="year" value="<?php echo $year?>" class="large-text"> 
    </div>

    <input type="hidden" name="customer" value="<?php echo $_GET['customer'];?>">

    <input type="hidden" name="mode" value="edit">

    <input type="hidden" name="action" value="tmm_desred_expenses_Form_Action">
   <?php

}

function tmm_desred_expenses_submit_btn_fun(){
    ?>
    <button name="btn_smt" class="button button-primary button-large">Submit</button>
    <?php
}


function tmm_desred_expenses_add_form_fun(){

    ?>

   <div class="form_field">
        <label><strong><?php _e( 'Department', 'tmm-desred-expenses-funds' ); ?></strong></label>
        <input type="text" name="department" placeholder="department" value="" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'causes', 'tmm-desred-expenses-funds' ); ?></strong></label>
        <input type="text" name="causes" placeholder="causes" value="" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Amount', 'tmm-desred-expenses-funds' ); ?></strong></label>
        <input type="text" name="amount" placeholder="amount" value="" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Year', 'tmm-desred-expenses-funds' ); ?></strong></label>
        <input type="text" name="year" placeholder="year" value="" class="large-text"> 
    </div>

    <input type="hidden" name="action" value="tmm_desred_expenses_Form_Action">

    <input type="hidden" name="mode" value="add">
    <?php
}


function tmm_desred_expenses_image_fun(){

    $thumbnail_id = tmm_desred_get_image($_GET['customer'], 'expenses');

    tmm_desred_upload_image('tmm_desred_upload_image', $thumbnail_id);
}

function tmm_desred_expenses_add_option() {

    add_meta_box("tmm-desred-expenses-edit-form", "Member", "tmm_desred_expenses_edit_form_fun", "tmm-desred-expenses-edit-form", "normal");

    add_meta_box("tmm-desred-expenses-add-form", "Member", "tmm_desred_expenses_add_form_fun", "tmm-desred-expenses-add-form", "normal");

    add_meta_box("tmm-desred-expenses-submit-btn", "Publish", "tmm_desred_expenses_submit_btn_fun", "tmm-desred-expenses-side", "side");

    add_meta_box("tmm-desred-featured-image", "Image", "tmm_desred_expenses_image_fun", "tmm-desred-expenses-side", "side");

    $option = 'per_page';
 
	$args = array(
	    'label' => 'Customer',
	    'default' => 10,
	    'option' => 'customer_list_per_page'
	);
	 
	add_screen_option( $option, $args );

    $exampleListTable = new TmmDesredExpenses();

}


add_filter('set-screen-option', 'tmm_desred_expenses_set_option', 10, 3);
 
function tmm_desred_expenses_set_option($status, $option, $value) {
 
    if ( 'customer_list_per_page' == $option ) return $value;
 
    return $status;
 
}


add_action('admin_post_tmm_desred_expenses_Form_Action', 'tmm_desred_expenses_Form_Action');
add_action('admin_post_nopriv_tmm_desred_expenses_Form_Action', 'tmm_desred_expenses_Form_Action');
function tmm_desred_expenses_Form_Action(){

    global $wpdb;

    if ($_POST['mode'] == 'add') { 

        $wpdb->insert( 
            "{$wpdb->prefix}tmm_expenses_tb", 
            array( 
                //'member_id' => $_POST['member_id'],
                'department' => $_POST['department'],
                'causes' => $_POST['causes'],
                'amount' => $_POST['amount'],
                'year' => $_POST['year'],  
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

        //subtract balance
        subtract_balance($_POST['amount']);

        if($wpdb->last_error !== '') { 

            $_SESSION['add_error_message_session'] = $wpdb->last_error;
            $redirect_url = admin_url().'admin.php?page=tmm-desred-expenses&action=add';
            wp_redirect($redirect_url);
            die();

        }else{

            $_SESSION['add_message_session'] = 'Save successfully';
            
        }


    }  


    if ($_POST['mode'] == 'edit') {

        $wpdb->update( 
            "{$wpdb->prefix}tmm_expenses_tb", 
            array( 
                //'member_id' => $_POST['member_id'],
                'department' => $_POST['department'],
                'causes' => $_POST['causes'],
                'amount' => $_POST['amount'],
                'year' => $_POST['year']
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

            $redirect_url = admin_url().'admin.php?page=tmm-desred-expenses&action=edit&customer='.$lastid;
            wp_redirect($redirect_url);
            die();

        }else{

           $_SESSION['edit_message_session'] = 'Updated successfully';
            
        }

    }

    tmm_desred_upload_image_save($lastid, 'expenses');

    $delete_nonce = wp_create_nonce( 'sp_delete_customer' );
    
    $redirect_url = admin_url().'admin.php?page=tmm-desred-expenses&action=edit&customer='.$lastid;
    wp_redirect($redirect_url);
    die();
}

function tmm_desred_expenses_admin_notice__success() {

  $screen = get_current_screen();

  //if ( $screen->id !== 'toplevel_page_tmm-desred-expenses') return;

    if (isset($_SESSION["add_message_session"])) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e( $_SESSION['add_message_session'], 'tmm-desred-expenses-funds' ); ?></p>
        </div>
        <?php
        if (basename($_SERVER['PHP_SELF']) != $_SESSION["add_message_session"]) {
            unset($_SESSION['add_message_session']);
        }
    }


    if (isset($_SESSION["edit_message_session"])) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e( $_SESSION['edit_message_session'], 'tmm-desred-expenses-funds' ); ?></p>
        </div>
        <?php
        if (basename($_SERVER['PHP_SELF']) != $_SESSION["edit_message_session"]) {
            unset($_SESSION['edit_message_session']);
        }
    }

    if (isset($_SESSION["add_error_message_session"])) {
        ?>
        <div class="notice notice-error is-dismissible">
            <p><?php _e( $_SESSION['add_error_message_session'], 'tmm-desred-expenses-funds' ); ?></p>
        </div>
        <?php
        if (basename($_SERVER['PHP_SELF']) != $_SESSION["add_error_message_session"]) {
            unset($_SESSION['add_error_message_session']);
        }
    }

}
add_action( 'admin_notices', 'tmm_desred_expenses_admin_notice__success' );