<?php


if(is_admin())
{
    new Paulund_Wp_List_Table();
}
/**
 * Paulund_Wp_List_Table class will create the page to load the table
 */
class Paulund_Wp_List_Table
{
    /**
     * Constructor will create the menu item
     */
    public function __construct()
    {
        add_action( 'admin_menu', array($this, 'add_menu_example_list_table_page' ));
    }
    /**
     * Menu item will allow us to load the page to display the table
     */
    public function add_menu_example_list_table_page()
    {
        add_menu_page( 'Example List Table', 'Example List Table', 'manage_options', 'example-list-table.php', array($this, 'list_table_page') );
    }
    /**
     * Display the list table page
     *
     * @return Void
     */
    public function list_table_page()
    {
        $exampleListTable = new Example_List_Table();
        $exampleListTable->prepare_items();
        ?>
            <div class="wrap">
                <div id="icon-users" class="icon32"></div>
                <h2>Example List Table Page</h2>
                <?php $exampleListTable->display(); ?>
            </div>
        <?php
    }
}



//Dash
function TmmDesred_Dash_admin_tabs($current = 'homepage') { 

    $tabs = array( 
      'tab1' => 'Tab1',
      'tab2' => 'Tab2',
      'tab3' => 'Tab3'
    );

    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<div class="nav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? 'nav-tab-active' : '';
        echo "<a class='nav-tab $class' href='?page=tmm-desred-tab&tab=$tab'>$name</a>";

    }
    echo '</div>';
}
//Dash

add_action( 'admin_menu', 'tmm_desred_sangh_admin_menu_page_fun_tab');
function tmm_desred_sangh_admin_menu_page_fun_tab(){


    $title = "Tabs";
    $hookpp = add_menu_page( $title, $title, 'manage_options', 'tmm-desred-tab', 'tmm_desred_sangh_admin_menu_fun_tab');
    //add_action( "load-$hook", 'tmm_desred_tab_add_option');



}

function tmm_desred_tab_add_option(){
	$exampleListTable = new TmmDesredSangh();
	$exampleListTable = new TmmDesredMahasangh();
}


function tmm_desred_sangh_admin_menu_fun_tab(){

	 global $wpdb;
?>
<div class="wrap">

<hr class="wp-header-end">

<!---->
<?php
if ( isset ( $_GET['tab'] ) ) TmmDesred_Dash_admin_tabs($_GET['tab']); else TmmDesred_Dash_admin_tabs('tab1');

if ( isset ( $_GET['tab'] ) ) $tab = $_GET['tab']; else $tab = 'tab1';

echo '<table class="form-table">';
switch ( $tab ){

  case 'tab1' :

  $exampleListTable = new TmmDesredSangh();


if ($_GET['action'] == 'add') {
	
        ?>
        <h2><?php _e( 'Add Sangh', 'tmm-desred-sangh-funds' ); ?></h2>
        <form id="form_tmm_desred_sangh" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="postbox-container-2" class="postbox-container">
                        <!--normal-->
                       <?php do_meta_boxes("tmm-desred-sangh-add-form", "normal", null); ?>
                    </div>
                    <div id="postbox-container-1" class="postbox-container">
                        <!--side-->
                        <?php do_meta_boxes("tmm-desred-sangh-submit-btn", "side", null); ?>
                    </div>
                </div>
                <br class="clear" />
            </div>
        </form>
        <?php
       
    }else if ($_GET['action'] == 'edit') {

        $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_sangh_tb WHERE ID=".$_GET['customer']);
       
        ?>
        <h1 class="wp-heading-inline"><?php _e( 'Edit Sangh', 'tmm-desred-sangh-funds' ); ?></h1>
        <a href="<?php echo admin_url();?>admin.php?page=tmm-desred-sangh&action=add" class="page-title-action">
            <?php _e( 'Add New', 'tmm-desred-sangh-funds' ); ?></a>
        <form id="form_tmm_desred_sangh" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="postbox-container-2" class="postbox-container">
                        <!--normal-->
                       <?php do_meta_boxes("tmm-desred-sangh-edit-form", "normal", $result); ?>
                    </div>
                    <div id="postbox-container-1" class="postbox-container">
                        <!--side-->
                        <?php do_meta_boxes("tmm-desred-sangh-submit-btn", "side", $result); ?>
                    </div>
                </div>
                <br class="clear" />
            </div>
        </form>
        <?php

       
    }else{

        $exampleListTable = new TmmDesredSangh();
        ?>

        <div>
        <h1 class="wp-heading-inline"><?php _e( 'Sangh', 'tmm-desred-sangh-funds' ); ?></h1>
        <a href="<?php echo admin_url();?>admin.php?page=tmm-desred-sangh&action=add" class="page-title-action"><?php _e( 'Add New', 'tmm-desred-sangh-funds' ); ?></a>
        <a href="<?php echo admin_url( 'admin-post.php?action=TmmDesredExportData&tb_name=tmm_sangh_tb' ); ?>" class="page-title-action">Export</a>
        </div>
        
        
        <form id="tmm_desred_sangh_form" method="get">
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
  break;

  case 'tab2' :

  		$exampleListTable = new TmmDesredMahasangh();
  		
  		if ($_GET['action'] == 'add') {
                ?>
                <h2><?php _e( 'Add Mahasangh', 'tmm-desred-mahasangh-funds' ); ?></h2>
                <form id="form_tmm_desred_mahasangh" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <div id="poststuff">
                        <div id="post-body" class="metabox-holder columns-2">
                            <div id="postbox-container-2" class="postbox-container">
                                <!--normal-->
                               <?php do_meta_boxes("tmm-desred-mahasangh-add-form", "normal", null); ?>
                            </div>
                            <div id="postbox-container-1" class="postbox-container">
                                <!--side-->
                                <?php do_meta_boxes("tmm-desred-mahasangh-submit-btn", "side", null); ?>
                            </div>
                        </div>
                        <br class="clear" />
                    </div>
                </form>
                <?php
               
            }else if ($_GET['action'] == 'edit') {

                $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_mahasangh_tb WHERE ID=".$_GET['customer']);
               
                ?>
                <h1 class="wp-heading-inline"><?php _e( 'Edit Mahasangh', 'tmm-desred-mahasangh-funds' ); ?></h1>
                <a href="<?php echo admin_url();?>admin.php?page=tmm-desred-mahasangh&action=add" class="page-title-action">
                    <?php _e( 'Add New', 'tmm-desred-mahasangh-funds' ); ?></a>
                <hr class="wp-header-end">
                <form id="form_tmm_desred_mahasangh" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <div id="poststuff">
                        <div id="post-body" class="metabox-holder columns-2">
                            <div id="postbox-container-2" class="postbox-container">
                                <!--normal-->
                               <?php do_meta_boxes("tmm-desred-mahasangh-edit-form", "normal", $result); ?>
                            </div>
                            <div id="postbox-container-1" class="postbox-container">
                                <!--side-->
                                <?php do_meta_boxes("tmm-desred-mahasangh-submit-btn", "side", $result); ?>
                            </div>
                        </div>
                        <br class="clear" />
                    </div>
                </form>
                <?php

               
            }else{

                $exampleListTable = new TmmDesredMahasangh();
                ?>
                <h1 class="wp-heading-inline"><?php _e( 'Mahasangh', 'tmm-desred-mahasangh-funds' ); ?></h1>
                <a href="<?php echo admin_url();?>admin.php?page=tmm-desred-mahasangh&action=add" class="page-title-action"><?php _e( 'Add New', 'tmm-desred-mahasangh-funds' ); ?></a>
                <hr class="wp-header-end">
                <form id="tmm_desred_mahasangh_form" method="get">
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
  break;

  case 'tab3' :
     ?>
     tab3
     <?php
  break;

}
echo '</table>';
?>
<!---->
<div>
<?php
}