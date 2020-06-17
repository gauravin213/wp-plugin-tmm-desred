<?php

defined( 'ABSPATH' ) || exit;

//MyWpListTable{table_name} like TmmDesredMembers

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class TmmDesredMembers extends WP_List_Table{

    /** Class constructor */
    public function __construct() {

        parent::__construct( [
            'singular' => __( 'Member', 'sp' ), //singular name of the listed records
            'plural'   => __( 'Members', 'sp' ), //plural name of the listed records
            'ajax'     => false //does this table support ajax?
        ] );

    }

    
    /**
     * Prepare the items for the table to process
     *
     * @return Void
     */
    public function prepare_items(){

        $per_page = $this->get_items_per_page( 'customer_list_per_page', 5 );

        $this->process_bulk_action();

        $data = $this->table_data();

        //search box
        $user_search_key = isset( $_REQUEST['s'] ) ? wp_unslash( trim( $_REQUEST['s'] ) ) : '';
        if( $user_search_key ) { 
            $data = $this->filter_table_data( $data, $user_search_key );
        }
        
        $this->_column_headers = $this->get_column_info();

        //Paginate
        $table_page = $this->get_pagenum();     
        $this->items = array_slice( $data, ( ( $table_page - 1 ) * $per_page ), $per_page );
        $totalItems = count( $data );
        $this->set_pagination_args( array (
            'total_items' => $totalItems,
            'per_page'    => $per_page,
            'total_pages' => ceil( $totalItems/$per_page )
        ) );

    }



    //
    // filter the table data based on the search key
    public function filter_table_data( $table_data, $search_key ) {
        $filtered_table_data = array_values( array_filter( $table_data, function( $row ) use( $search_key ) {
            foreach( $row as $row_val ) {
                if( stripos( $row_val, $search_key ) !== false ) {
                    return true;
                }               
            }           
        } ) );

        return $filtered_table_data;

    }
    //

    /**
     * Returns an associative array containing the bulk action
     *
     * @return array
     */
    public function get_bulk_actions() {

        $current = ( !empty($_REQUEST['customer_status']) ? $_REQUEST['customer_status'] : 'all');

        if ( 'trash' === $current ) {
            $actions = [
            'bulk-untrash' => 'Restore',
            'bulk-delete' => 'Delete Permanently'
            ];

        }else{
            $actions = [
            'bulk-trash' => 'Trash'
            ];
        }
        

        return $actions;
    }

    public function process_bulk_action() { 

        if ( 'trash' === $this->current_action() ) {

            $nonce = esc_attr( $_REQUEST['_wpnonce'] );

            if ( ! wp_verify_nonce( $nonce, 'sp_nonce_customer' ) ) {
                die( 'Go get a life script kiddies' );
            }
            else {
                self::set_status_customer( absint( $_GET['customer']), 'trash' );
                /*$pp = admin_url().'admin.php?page=tmm-desred-members';
                wp_redirect($pp);
                exit;*/
            }

        }

        if ( 'untrash' === $this->current_action() ) {

            $nonce = esc_attr( $_REQUEST['_wpnonce'] );

            if ( ! wp_verify_nonce( $nonce, 'sp_nonce_customer' ) ) {
                die( 'Go get a life script kiddies' );
            }
            else {
                self::set_status_customer( absint( $_GET['customer']), 'publish' );
                /*$pp = admin_url().'admin.php?page=tmm-desred-members';
                wp_redirect($pp);
                exit;*/
            }

        }

        if ( 'delete' === $this->current_action() ) {

            $nonce = esc_attr( $_REQUEST['_wpnonce'] );

            if ( ! wp_verify_nonce( $nonce, 'sp_nonce_customer' ) ) {
                die( 'Go get a life script kiddies' );
            }
            else {
                self::delete_customer( absint( $_GET['customer'] ) );
                /*$pp = admin_url().'admin.php?page=tmm-desred-members';
                wp_redirect($pp);
                exit;*/
            }

        }


        // If the delete bulk action is triggered
        if ( ( isset( $_GET['action'] ) && $_GET['action'] == 'bulk-delete' )
             || ( isset( $_GET['action2'] ) && $_GET['action2'] == 'bulk-delete' )
        ) {

            $delete_ids = esc_sql( $_GET['bulk-delete'] );

            foreach ( $delete_ids as $id ) {
                self::delete_customer( $id );
                //self::set_status_customer( $id, 'trash' );
            }
            /*wp_redirect( esc_url_raw(add_query_arg()) );
            exit;*/
        }

        if ( ( isset( $_GET['action'] ) && $_GET['action'] == 'bulk-trash' )
             || ( isset( $_GET['action2'] ) && $_GET['action2'] == 'bulk-trash' )
        ) {

            $delete_ids = esc_sql( $_GET['bulk-delete'] );

            foreach ( $delete_ids as $id ) {
                //self::delete_customer( $id );
                self::set_status_customer( $id, 'trash' );
            }
            /*wp_redirect( esc_url_raw(add_query_arg()) );
            exit;*/
        }

        if ( ( isset( $_GET['action'] ) && $_GET['action'] == 'bulk-untrash' )
             || ( isset( $_GET['action2'] ) && $_GET['action2'] == 'bulk-untrash' )
        ) {

            $delete_ids = esc_sql( $_GET['bulk-delete'] );

            foreach ( $delete_ids as $id ) {
                //self::delete_customer( $id );
                self::set_status_customer( $id, 'publish' );
            }
            /*wp_redirect( esc_url_raw(add_query_arg()) );
            exit;*/
        }


        
    }


    public static function delete_customer( $id ) {
        global $wpdb;

        $wpdb->delete(
            "{$wpdb->prefix}tmm_members_tb",
            [ 'ID' => $id ],
            [ '%d' ]
        );
    }

    public static function set_status_customer( $id, $status) {

        global $wpdb;

        $wpdb->update( 
           "{$wpdb->prefix}tmm_members_tb",
            array( 
                'status' => $status, 
            ), 
            array( 'ID' => $id ), 
            array( 
                '%s',
            ), 
            array( '%d' ) 
            );
        }


    /**
     * Get the table data
     *
     * @return Array
     */
    private function table_data(){ 


        global $wpdb;

        $sql = "SELECT * FROM {$wpdb->prefix}tmm_members_tb";

        $customer_status = ( isset($_REQUEST['customer_status']) ? $_REQUEST['customer_status'] : 'publish');
        if($customer_status != '') {
            $sql .= " WHERE status LIKE '" .$customer_status. "'";
        } else  {
            $sql .= '';
        }

        $sql .= get_filter_by_colum_name_sql($this->get_columns());


        if ( ! empty( $_REQUEST['orderby'] ) ) { 
            $sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
            $sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
        }else{
            $sql .= ' ORDER BY ID DESC';
        }

        //echo $sql;

        $result = $wpdb->get_results( $sql, 'ARRAY_A' );

        return $result;

    }


    public function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['ID']
        );
    }

    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns(){  

        $columns = array(
            'cb'      => '<input type="checkbox" />',
            'image'       => 'Image',
            'name'       => 'Name',
            'lm_number'       => 'Lm number',
            'siniority_list_number'       => 'Siniority list number',
            'lm_number_mahasangh'       => 'L.M. No. Mahasangh',
            //'address' => 'Address',
            'city' => 'City',
            'assistant_engineers' => 'Assistant engineers',
            'father_or_husband_name' => 'Father/Husband Name',
            'date_of_birth' => 'DOB',
            'district' => 'District',
            'circle' => 'Circle',
            'cast' => 'Cast',
            'dy_cast' => 'DY Cast',
            'date_of_retirement' => 'DOR',
            'appointment_letter_number_and_date' => 'Appointment Letter',
            'mobile_number' => 'Mobile',
            'whatsApp_number' => 'WhatsApp',
            'email' => 'Email'
        );
        return $columns;
    }


    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns(){

        return array();

    }

    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default( $item, $column_name ){

        switch( $column_name ) {

            case 'ID':
            case 'image': 
                
            $thumbnail_id = tmm_desred_get_image($item['ID'], 'member');
            
            if (!empty($thumbnail_id)) {
                $image = wp_get_attachment_image_src( $thumbnail_id, 'medium' );
                $url = $image[0];
            }else{
                $url = TmmDesred_URL.'assets/image/person-placeholder.png';
            }

            echo '<img src="'.$url.'"  style="max-width:100px;">';
               
            case 'name':
            case 'lm_number':
            case 'siniority_list_number':
            case 'lm_number_mahasangh':
            //case 'address':
            case 'city':
            case 'assistant_engineers':
            case 'father_or_husband_name':
            case 'date_of_birth':
            case 'district':
            case 'circle':
            case 'cast':
            case 'dy_cast':
            case 'date_of_retirement':
            case 'appointment_letter_number_and_date':
            case 'mobile_number':
            case 'whatsApp_number':
            case 'email':
                return $item[ $column_name ];
            default:
                return print_r( $item, true ) ;
        }
    }

    /*
    * Action On click
    */
    public function column_name( $item ) {

        $sp_nonce_customer = wp_create_nonce( 'sp_nonce_customer' );

        $title = '<strong>' . $item['name'] . '</strong>';

        $current = ( !empty($_REQUEST['customer_status']) ? $_REQUEST['customer_status'] : 'all');

        if ($current == 'trash') {

            $actions = [
                'edit' => sprintf( '<a href="?page=%s&action=%s&customer=%s&_wpnonce=%s">Restore</a>', esc_attr( $_REQUEST['page'] ), 'untrash', absint( $item['ID'] ), $sp_nonce_customer ),
                'delete' => sprintf( '<a href="?page=%s&action=%s&customer=%s&_wpnonce=%s">Delete Permanently</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item['ID'] ), $sp_nonce_customer )
            ];
           
        }else if($current == 'all'){

            $actions = [
                'edit' => sprintf( '<a href="?page=%s&action=%s&customer=%s&_wpnonce=%s">Edit</a>', esc_attr( $_REQUEST['page'] ), 'edit', absint( $item['ID'] ), $sp_nonce_customer ),
                'trash' => sprintf( '<a href="?page=%s&action=%s&customer=%s&_wpnonce=%s">Trash</a>', esc_attr( $_REQUEST['page'] ), 'trash', absint( $item['ID'] ), $sp_nonce_customer ),
                'view' => '<a class="view_data" href="#" data-ID="'.$item['ID'].'" data-tbn="tmm_members_tb" data-sourse-type="member">View</a>',
                'report' => '<a href="'.admin_url().'admin.php?page=tmm-report&lm_number='.$item['lm_number'].'">Report</a>',
            ];


        }else{

            //
        }

        

        return $title . $this->row_actions( $actions );
    }


    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns(){ 
        return array(
            'name' => array('name', false),
            'lm_number' => array('lm_number', false),
            'siniority_list_number' => array('siniority_list_number', false),
            'lm_number_mahasangh' => array('lm_number_mahasangh', false),
            
            //'address' => array('address', false),
            'city' => array('city', false),
            'assistant_engineers' => array('assistant_engineers', false),
            'father_or_husband_name' => array('father_or_husband_name', false),
            'date_of_birth' => array('date_of_birth', false),
            'district' => array('district', false),
            'circle' => array('circle', false),
            'cast' => array('cast', false),
            'dy_cast' => array('dy_cast', false),
            'date_of_retirement' => array('date_of_retirement', false),
            'appointment_letter_number_and_date' => array('appointment_letter_number_and_date', false),
            'mobile_number' => array('mobile_number', false),
            'whatsApp_number' => array('whatsApp_number', false),
            'email' => array('email', false)
        );
    }

    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
    private function sort_data( $a, $b ){
        // Set defaults
        $order = 'asc';
        // If orderby is set, use this as the sort column
        if(!empty($_GET['orderby']))
        {
            $orderby = $_GET['orderby'];
        }
        // If order is set use this as the order
        if(!empty($_GET['order']))
        {
            $order = $_GET['order'];
        }
        $result = strcmp( $a[$orderby], $b[$orderby] );
        if($order === 'asc')
        {
            return $result;
        }
        return -$result;
    }



    protected function get_views() { 
      $views = array();
       $current = ( !empty($_REQUEST['customer_status']) ? $_REQUEST['customer_status'] : 'all');

       //All link
       $class = ($current == 'all' ? ' class="current"' :'');
       $all_url = remove_query_arg('customer_status');
       $views['all'] = "<a href='{$all_url }' {$class} >All</a>";

       //Trash link
       $trash = add_query_arg('customer_status','trash');
       $class = ($current == 'trash' ? ' class="current"' :'');
       $views['trash'] = "<a href='{$trash}' {$class} >Trash</a>";

       return $views;
    }



    function extra_tablenav( $which ) {
        global $wpdb, $testiURL, $tablename, $tablet;
        
        if ( $which == "top" ){   
            get_filter_by_colum_name($this->get_columns(), 'tmm_members_tb');
        }
        if ( $which == "bottom" ){
            //The code that goes after the table is there

        }
    }


}