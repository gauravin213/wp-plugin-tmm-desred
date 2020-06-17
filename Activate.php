<?php
/**
 * Class Activate
 * @package App
 */
if ( ! class_exists( 'Activate' ) ) {
	/**
	 * Class Activate
	 * @package App\Activate
	 */
	class Activate {

		function __construct(){
			//echo "Activate";
		}


		public static function activate() {  

			global $table_prefix, $wpdb;

		    $tblname = 'tmm_members_tb';
		    $wp_track_table = $table_prefix . "$tblname ";
		    if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) {

		        $sql = "CREATE TABLE IF NOT EXISTS {$wp_track_table} (
		          ID INT AUTO_INCREMENT PRIMARY KEY,
		          lm_number VARCHAR(255) NOT NULL,
		          siniority_list_number VARCHAR(255) NOT NULL,
		          lm_number_mahasangh VARCHAR(255) NOT NULL,
		          name VARCHAR(255) NOT NULL,
		          gender VARCHAR(255) NOT NULL,
		          blood_group VARCHAR(255) NOT NULL,
		          local_address VARCHAR(255) NOT NULL,
		          permanent_address VARCHAR(255) NOT NULL,
		          date_of_joining VARCHAR(255) NOT NULL,
		          first_posting_city VARCHAR(255) NOT NULL,
		          assistant_engineers VARCHAR(255) NOT NULL,
		          father_or_husband_name VARCHAR(255) NOT NULL,
		          date_of_birth VARCHAR(255) NOT NULL,
		          district VARCHAR(255) NOT NULL,
		          circle VARCHAR(255) NOT NULL,
		          cast VARCHAR(255) NOT NULL,
		          dy_cast VARCHAR(255) NOT NULL,
		          date_of_retirement VARCHAR(255) NOT NULL,
		          appointment_letter_number_and_date VARCHAR(255) NOT NULL,
		          mobile_number VARCHAR(255) NOT NULL,
		          whatsApp_number VARCHAR(255) NOT NULL,
		          email VARCHAR(255) NOT NULL,
		          status VARCHAR(255) NOT NULL,
		          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		        );";

		        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
		        dbDelta($sql);
		    }


		    $tblname = 'tmm_sangh_tb';
		    $wp_track_table = $table_prefix . "$tblname ";
		    if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) {

		        $sql = "CREATE TABLE IF NOT EXISTS {$wp_track_table} (
		          ID INT AUTO_INCREMENT PRIMARY KEY,
		          lm_number VARCHAR(255) NOT NULL,
		          amount VARCHAR(255) NOT NULL,
		          year VARCHAR(255) NOT NULL,
		          status VARCHAR(255) NOT NULL,
		          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		        );";

		        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
		        dbDelta($sql);
		    }

		    $tblname = 'tmm_posting_tb';
		    $wp_track_table = $table_prefix . "$tblname ";
		    if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) {

		        $sql = "CREATE TABLE IF NOT EXISTS {$wp_track_table} (
		          ID INT AUTO_INCREMENT PRIMARY KEY,
		          lm_number VARCHAR(255) NOT NULL,
		          address VARCHAR(255) NOT NULL,
		          year VARCHAR(255) NOT NULL,
		          status VARCHAR(255) NOT NULL,
		          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		        );";

		        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
		        dbDelta($sql);
		    }

		    $tblname = 'tmm_expire_tb';
		    $wp_track_table = $table_prefix . "$tblname ";
		    if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) {

		        $sql = "CREATE TABLE IF NOT EXISTS {$wp_track_table} (
		          ID INT AUTO_INCREMENT PRIMARY KEY,
		          lm_number VARCHAR(255) NOT NULL,
		          year VARCHAR(255) NOT NULL,
		          status VARCHAR(255) NOT NULL,
		          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		        );";

		        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
		        dbDelta($sql);
		    }

		    $tblname = 'tmm_blood_donation_tb';
		    $wp_track_table = $table_prefix . "$tblname ";
		    if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) {

		        $sql = "CREATE TABLE IF NOT EXISTS {$wp_track_table} (
		          ID INT AUTO_INCREMENT PRIMARY KEY,
		          lm_number VARCHAR(255) NOT NULL,
		          date_of_blood_donation VARCHAR(255) NOT NULL,
		          note VARCHAR(255) NULL,
		          status VARCHAR(255) NOT NULL,
		          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		        );";

		        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
		        dbDelta($sql);
		    }

		    $tblname = 'tmm_mahasangh_tb';
		    $wp_track_table = $table_prefix . "$tblname ";
		    if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) {

		        $sql = "CREATE TABLE IF NOT EXISTS {$wp_track_table} (
		          ID INT AUTO_INCREMENT PRIMARY KEY,
		          lm_number VARCHAR(255) NOT NULL,
		          amount VARCHAR(255) NOT NULL,
		          year VARCHAR(255) NOT NULL,
		          status VARCHAR(255) NOT NULL,
		          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		        );";

		        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
		        dbDelta($sql);
		    }

		    $tblname = 'tmm_anshdan_tb';
		    $wp_track_table = $table_prefix . "$tblname ";
		    if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) {

		        $sql = "CREATE TABLE IF NOT EXISTS {$wp_track_table} (
		          ID INT AUTO_INCREMENT PRIMARY KEY,
		          lm_number VARCHAR(255) NOT NULL,
		          amount VARCHAR(255) NOT NULL,
		          kendra_amount VARCHAR(255) NOT NULL,
		          janpad_amount VARCHAR(255) NOT NULL,
		          mandal_amount VARCHAR(255) NOT NULL,

		          year VARCHAR(255) NOT NULL,
		          status VARCHAR(255) NOT NULL,
		          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		        );";

		        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
		        dbDelta($sql);
		    }

		    $tblname = 'tmm_family_welfare_scheme_tb';
		    $wp_track_table = $table_prefix . "$tblname ";
		    if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) {

		        $sql = "CREATE TABLE IF NOT EXISTS {$wp_track_table} (
		          ID INT AUTO_INCREMENT PRIMARY KEY,
		          lm_number VARCHAR(255) NOT NULL,
		          level VARCHAR(255) NOT NULL,
		          amount VARCHAR(255) NOT NULL,
		          card_number VARCHAR(255) NOT NULL,
		          year VARCHAR(255) NOT NULL,
		          status VARCHAR(255) NOT NULL,
		          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		        );";

		        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
		        dbDelta($sql);
		    }


		    $tblname = 'tmm_family_welfare_scheme_mahasangh_tb';
		    $wp_track_table = $table_prefix . "$tblname ";
		    if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) {

		        $sql = "CREATE TABLE IF NOT EXISTS {$wp_track_table} (
		          ID INT AUTO_INCREMENT PRIMARY KEY,
		          lm_number VARCHAR(255) NOT NULL,
		          level VARCHAR(255) NOT NULL,
		          amount VARCHAR(255) NOT NULL,
		          card_number VARCHAR(255) NOT NULL,
		          year VARCHAR(255) NOT NULL,
		          status VARCHAR(255) NOT NULL,
		          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		        );";

		        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
		        dbDelta($sql);
		    }



		    $tblname = 'tmm_building_fund_tb';
		    $wp_track_table = $table_prefix . "$tblname ";
		    if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) {

		        $sql = "CREATE TABLE IF NOT EXISTS {$wp_track_table} (
		          ID INT AUTO_INCREMENT PRIMARY KEY,
		          lm_number VARCHAR(255) NOT NULL,
		          amount VARCHAR(255) NOT NULL,
		          p_no VARCHAR(255) NOT NULL,
		          grad VARCHAR(255) NOT NULL,
		          year VARCHAR(255) NOT NULL,
		          status VARCHAR(255) NOT NULL,
		          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		        );";

		        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
		        dbDelta($sql);
		    }


		    $tblname = 'tmm_maha_adhiveshan_tb';
		    $wp_track_table = $table_prefix . "$tblname ";
		    if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) {

		        $sql = "CREATE TABLE IF NOT EXISTS {$wp_track_table} (
		          ID INT AUTO_INCREMENT PRIMARY KEY,
		          lm_number VARCHAR(255) NOT NULL,
		          fee_amount VARCHAR(255) NOT NULL,
		          reg_acount VARCHAR(255) NOT NULL,
		          year VARCHAR(255) NOT NULL,
		          status VARCHAR(255) NOT NULL,
		          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		        );";

		        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
		        dbDelta($sql);
		    }

		    $tblname = 'tmm_expenses_tb';
		    $wp_track_table = $table_prefix . "$tblname ";
		    if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) {

		        $sql = "CREATE TABLE IF NOT EXISTS {$wp_track_table} (
		          ID INT AUTO_INCREMENT PRIMARY KEY,
		          department VARCHAR(255) NOT NULL,
		          causes VARCHAR(255) NOT NULL,
		          amount VARCHAR(255) NOT NULL,
		          year VARCHAR(255) NOT NULL,
		          status VARCHAR(255) NOT NULL,
		          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		        );";

		        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
		        dbDelta($sql);
		    }

		    $tblname = 'tmm_images_tb';
		    $wp_track_table = $table_prefix . "$tblname ";
		    if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) {

		        $sql = "CREATE TABLE IF NOT EXISTS {$wp_track_table} (
		          ID INT AUTO_INCREMENT PRIMARY KEY,
		          post_id VARCHAR(255) NOT NULL,
		          sourse_type VARCHAR(255) NOT NULL,
		          thumbnail_id VARCHAR(255) NOT NULL,
		          image_url VARCHAR(255) NOT NULL,
		          status VARCHAR(255) NOT NULL,
		          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		        );";

		        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
		        dbDelta($sql);
		    }

		    $tblname = 'tmm_balance_tb';
		    $wp_track_table = $table_prefix . "$tblname ";
		    if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) {

		        $sql = "CREATE TABLE IF NOT EXISTS {$wp_track_table} (
		          id INT AUTO_INCREMENT PRIMARY KEY,
		          balance VARCHAR(255) NOT NULL,
		          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		        );";

		        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
		        dbDelta($sql);
		    }

		}

	}

}