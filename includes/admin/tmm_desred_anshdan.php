<?php

defined( 'ABSPATH' ) || exit;

//my_wp_list_table_{table_name} like  tmm_desred_anshdan  tmm-desred-anshdan 

/*add_action( 'admin_menu', 'tmm_desred_anshdan_admin_menu_page_fun');
function tmm_desred_anshdan_admin_menu_page_fun(){

    $title = "desred anshdan";
    $hook = add_menu_page( $title, $title, 'manage_options', 'tmm-desred-anshdan', 'tmm_desred_anshdan_admin_menu_fun');

    add_action( "load-$hook", 'tmm_desred_anshdan_add_option');

}*/

function tmm_desred_anshdan_admin_menu_fun(){
?>  
<div class="wrap">
        <?php
            global $wpdb;

            if ($_GET['action'] == 'add') {
                ?>
                <h2><?php _e( 'Add Anshdan', 'tmm-desred-anshdan-funds' ); ?></h2>
                <form id="form_tmm_desred_anshdan" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <div id="poststuff">
                        <div id="post-body" class="metabox-holder columns-2">
                            <div id="postbox-container-2" class="postbox-container">
                                <!--normal-->
                               <?php do_meta_boxes("tmm-desred-anshdan-add-form", "normal", null); ?>
                            </div>
                            <div id="postbox-container-1" class="postbox-container">
                                <!--side-->
                                <?php do_meta_boxes("tmm-desred-anshdan-submit-btn", "side", null); ?>
                            </div>
                        </div>
                        <br class="clear" />
                    </div>
                </form>
                <?php
               
            }else if ($_GET['action'] == 'edit') {

                $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_anshdan_tb WHERE ID=".$_GET['customer']);
               
                ?>
                <h1 class="wp-heading-inline"><?php _e( 'Edit Anshdan', 'tmm-desred-anshdan-funds' ); ?></h1>
                <a href="<?php echo admin_url();?>admin.php?page=tmm-desred-anshdan&action=add" class="page-title-action">
                    <?php _e( 'Add New', 'tmm-desred-anshdan-funds' ); ?></a>
                <hr class="wp-header-end">
                <form id="form_tmm_desred_anshdan" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <div id="poststuff">
                        <div id="post-body" class="metabox-holder columns-2">
                            <div id="postbox-container-2" class="postbox-container">
                                <!--normal-->
                               <?php do_meta_boxes("tmm-desred-anshdan-edit-form", "normal", $result); ?>
                            </div>
                            <div id="postbox-container-1" class="postbox-container">
                                <!--side-->
                                <?php do_meta_boxes("tmm-desred-anshdan-submit-btn", "side", $result); ?>
                            </div>
                        </div>
                        <br class="clear" />
                    </div>
                </form>
                <?php

               
            }else{

                $exampleListTable = new TmmDesredAnshdan();
                ?>
                <h1 class="wp-heading-inline"><?php _e( 'Anshdan', 'tmm-desred-anshdan-funds' ); ?></h1>
                <a href="<?php echo admin_url();?>admin.php?page=tmm-desred-anshdan&action=add" class="page-title-action"><?php _e( 'Add New', 'tmm-desred-anshdan-funds' ); ?></a>
                <hr class="wp-header-end">
                <form id="tmm_desred_anshdan_form" method="get">
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

function tmm_desred_anshdan_edit_form_fun($result){

    $lm_number = $result[0]->lm_number;
    $amount = $result[0]->amount;
    $kendra_amount = $result[0]->kendra_amount;
    $janpad_amount = $result[0]->janpad_amount;
    $mandal_amount = $result[0]->mandal_amount;

    $year = $result[0]->year;

   ?>
    <div class="form_field">
        <label><strong><?php _e( 'Lm number', 'tmm-desred-anshdan-funds' ); ?></strong></label>
        <?php
        $lm_number = !empty( $lm_number ) ? $lm_number : '';
        $name = 'lm_number';
        $get_member = get_member($name, $lm_number);
        ?>
        <label for="lm_number" class="error"></label>
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Amount', 'tmm-desred-anshdan-funds' ); ?></strong></label>
        <input type="text" name="amount" placeholder="amount" value="<?php echo $amount?>" class="large-text"> 
    </div>



    <div class="form_field">
        <label><strong><?php _e( 'Kendra', 'tmm-desred-anshdan-funds' ); ?></strong></label>
        <input type="text" name="kendra_amount" placeholder="Kendra amount" value="<?php echo $kendra_amount?>" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Janpad', 'tmm-desred-anshdan-funds' ); ?></strong></label>
        <input type="text" name="janpad_amount" placeholder="Janpad amount" value="<?php echo $janpad_amount?>" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Mandal', 'tmm-desred-anshdan-funds' ); ?></strong></label>
        <input type="text" name="mandal_amount" placeholder="Mandal amount" value="<?php echo $mandal_amount?>" class="large-text"> 
    </div>




    <div class="form_field">
        <label><strong><?php _e( 'Year', 'tmm-desred-anshdan-funds' ); ?></strong></label>
        <input type="text" name="year" placeholder="year" value="<?php echo $year?>" class="large-text"> 
    </div>

    <input type="hidden" name="customer" value="<?php echo $_GET['customer'];?>">

    <input type="hidden" name="mode" value="edit">

    <input type="hidden" name="action" value="tmm_desred_anshdan_Form_Action">
   <?php

}

function tmm_desred_anshdan_submit_btn_fun(){
    ?>
    <button name="btn_smt" class="button button-primary button-large">Submit</button>
    <?php
}


function tmm_desred_anshdan_add_form_fun(){

    ?>
    <div class="form_field">
        <label><strong><?php _e( 'Lm number', 'tmm-desred-anshdan-funds' ); ?></strong></label>
        <?php
        $lm_number = !empty( $lm_number ) ? $lm_number : '';
        $name = 'lm_number';
        $get_member = get_member($name, $lm_number);
        ?>
        <label for="lm_number" class="error"></label>
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Amount', 'tmm-desred-anshdan-funds' ); ?></strong></label>
        <input type="text" name="amount" placeholder="amount" value="" class="large-text"> 
    </div>



    <div class="form_field">
        <label><strong><?php _e( 'Kendra', 'tmm-desred-anshdan-funds' ); ?></strong></label>
        <input type="text" name="kendra_amount" placeholder="Kendra amount" value="" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Janpad', 'tmm-desred-anshdan-funds' ); ?></strong></label>
        <input type="text" name="janpad_amount" placeholder="Janpad amount" value="" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Mandal', 'tmm-desred-anshdan-funds' ); ?></strong></label>
        <input type="text" name="mandal_amount" placeholder="Mandal amount" value="" class="large-text"> 
    </div>




    <div class="form_field">
        <label><strong><?php _e( 'Year', 'tmm-desred-anshdan-funds' ); ?></strong></label>
        <input type="text" name="year" placeholder="year" value="" class="large-text"> 
    </div>

    <input type="hidden" name="action" value="tmm_desred_anshdan_Form_Action">

    <input type="hidden" name="mode" value="add">


    <script type="text/javascript">
        jQuery(document).ready(function(){

            jQuery(document).on('change', 'input[name=amount]', function(){

                var target = jQuery(this);

                var amount = target.val();

                var kendra_amount = amount * 50 / 100;
                var janpad_amount = amount * 35 /100;
                var mandal_amount = amount * 15 /100;

                jQuery('input[name=kendra_amount]').val(kendra_amount);
                jQuery('input[name=janpad_amount]').val(janpad_amount);
                jQuery('input[name=mandal_amount]').val(mandal_amount);

                console.log('kendra_amount: '+kendra_amount);
                console.log('janpad_amount: '+janpad_amount);
                console.log('mandal_amount: '+mandal_amount);

            });

        });
    </script>
    <?php
}

function tmm_desred_anshdan_add_option() {

    add_meta_box("tmm-desred-anshdan-edit-form", "Member", "tmm_desred_anshdan_edit_form_fun", "tmm-desred-anshdan-edit-form", "normal");

    add_meta_box("tmm-desred-anshdan-add-form", "Member", "tmm_desred_anshdan_add_form_fun", "tmm-desred-anshdan-add-form", "normal");

    add_meta_box("tmm-desred-anshdan-submit-btn", "Publish", "tmm_desred_anshdan_submit_btn_fun", "tmm-desred-anshdan-submit-btn", "side");

    $option = 'per_page';
 
	$args = array(
	    'label' => 'Customer',
	    'default' => 10,
	    'option' => 'customer_list_per_page'
	);
	 
	add_screen_option( $option, $args );

    $exampleListTable = new TmmDesredAnshdan();

}


add_filter('set-screen-option', 'tmm_desred_anshdan_set_option', 10, 3);
 
function tmm_desred_anshdan_set_option($status, $option, $value) {
 
    if ( 'customer_list_per_page' == $option ) return $value;
 
    return $status;
 
}


add_action('admin_post_tmm_desred_anshdan_Form_Action', 'tmm_desred_anshdan_Form_Action');
add_action('admin_post_nopriv_tmm_desred_anshdan_Form_Action', 'tmm_desred_anshdan_Form_Action');
function tmm_desred_anshdan_Form_Action(){

    global $wpdb;

    if ($_POST['mode'] == 'add') { 

        $wpdb->insert( 
            "{$wpdb->prefix}tmm_anshdan_tb", 
            array( 
                'lm_number' => $_POST['lm_number'],
                'amount' => $_POST['amount'],
                'kendra_amount' => $_POST['kendra_amount'],
                'janpad_amount' => $_POST['janpad_amount'],
                'mandal_amount' => $_POST['mandal_amount'],
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

        //Add balance
        add_balance($_POST['amount']);

        if($wpdb->last_error !== '') { 

            $_SESSION['add_error_message_session'] = $wpdb->last_error;
            $redirect_url = admin_url().'admin.php?page=tmm-desred-anshdan&action=add';
            wp_redirect($redirect_url);
            die();

        }else{

            $_SESSION['add_message_session'] = 'Save successfully';
            
        }


    }  


    if ($_POST['mode'] == 'edit') {

        $wpdb->update( 
            "{$wpdb->prefix}tmm_anshdan_tb", 
            array( 
                'lm_number' => $_POST['lm_number'],
                'amount' => $_POST['amount'],
                //'kendra_amount' => $_POST['kendra_amount'],
                //'janpad_amount' => $_POST['janpad_amount'],
                //'mandal_amount' => $_POST['mandal_amount'],
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

            $redirect_url = admin_url().'admin.php?page=tmm-desred-anshdan&action=edit&customer='.$lastid;
            wp_redirect($redirect_url);
            die();

        }else{

           $_SESSION['edit_message_session'] = 'Updated successfully';
            
        }


        
        
    }

    $delete_nonce = wp_create_nonce( 'sp_delete_customer' );
    
    $redirect_url = admin_url().'admin.php?page=tmm-desred-anshdan&action=edit&customer='.$lastid;
    wp_redirect($redirect_url);
    die();
}

function tmm_desred_anshdan_admin_notice__success() {

  $screen = get_current_screen();

  //if ( $screen->id !== 'toplevel_page_tmm-desred-anshdan') return;

    if (isset($_SESSION["add_message_session"])) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e( $_SESSION['add_message_session'], 'tmm-desred-anshdan-funds' ); ?></p>
        </div>
        <?php
        if (basename($_SERVER['PHP_SELF']) != $_SESSION["add_message_session"]) {
            unset($_SESSION['add_message_session']);
        }
    }


    if (isset($_SESSION["edit_message_session"])) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e( $_SESSION['edit_message_session'], 'tmm-desred-anshdan-funds' ); ?></p>
        </div>
        <?php
        if (basename($_SERVER['PHP_SELF']) != $_SESSION["edit_message_session"]) {
            unset($_SESSION['edit_message_session']);
        }
    }

    if (isset($_SESSION["add_error_message_session"])) {
        ?>
        <div class="notice notice-error is-dismissible">
            <p><?php _e( $_SESSION['add_error_message_session'], 'tmm-desred-anshdan-funds' ); ?></p>
        </div>
        <?php
        if (basename($_SERVER['PHP_SELF']) != $_SESSION["add_error_message_session"]) {
            unset($_SESSION['add_error_message_session']);
        }
    }

}
add_action( 'admin_notices', 'tmm_desred_anshdan_admin_notice__success' );