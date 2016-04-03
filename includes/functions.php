<?php 
 // This is the functions file

function mysql_prep( $value ) {
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
		if( $new_enough_php ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysql_real_escape_string( $value );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}
	
	function redirect_to( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}
			
 function confirm_query($result_set) {
	 if (!$result_set) {
   die("Database query failed: " . mysql_error());
  }
 }

 function get_all_sections($public = true) {
		global $db_connect;
		$query = "SELECT * 
				FROM tblSections ";
		if ($public) {
			$query .= "WHERE visible = 1 ";
		}
 	$query .=	"ORDER BY position ASC";
		$section_set = mysql_query($query, $db_connect);
		confirm_query($section_set);
		return $section_set;
	}
	
 function get_pages_for_section($section_id, $public = true) {
		global $db_connect;
		$query = "SELECT * 
	   FROM tblPages "; 
		$query .=	"WHERE section_id = {$section_id} ";
		if ($public) {
		 $query .= "AND visible = 1 ";
		}
		$query .= "ORDER BY position ASC";
		$page_set = mysql_query($query, $db_connect);
		confirm_query($page_set);
		return $page_set;
	}
	
function get_section_by_id($section_id) {
		global $db_connect;
		$query = "SELECT * ";
		$query .= "FROM tblSections ";
		$query .= "WHERE id='" . $section_id ."' ";
		$query .= "LIMIT 1";
		$result_set = mysql_query($query, $db_connect);
		confirm_query($result_set);
		// REMEMBER:
		// if no rows are returned, fetch_array will return false
		if ($section = mysql_fetch_array($result_set)) {
			return $section;
		} else {
			return NULL;
		}
	}

function get_page_by_id($page_id) {
		global $db_connect;
		$query = "SELECT * ";
		$query .= "FROM tblPages ";
		$query .= "WHERE id='" . $page_id ."' ";
		$query .= "LIMIT 1";
		$result_set = mysql_query($query, $db_connect);
		confirm_query($result_set);
		// REMEMBER:
		// if no rows are returned, fetch_array will return false
		if ($page = mysql_fetch_array($result_set)) {
			return $page;
		} else {
			return NULL;
		}
	}

function get_default_page($section_id) {
		// Get all visible pages
		$page_set = get_pages_for_section($section_id, true);
		if ($first_page = mysql_fetch_array($page_set)) {
			return $first_page;
		} else {
			return NULL;
		}
	}

function find_selected_page(){
global $sel_section;
global $sel_page;
if (isset($_GET['page'])){
		$sel_page = get_page_by_id($_GET['page']);
		$sel_section = get_section_by_id($_GET['sect']);	
} elseif (isset($_GET['sect'])){
		$sel_section = get_section_by_id($_GET['sect']);
		$sel_page = get_default_page($sel_section['id']);
} else {
			$sel_section = NULL;
			$sel_page = NULL;
 }
}

function section_check(){
	global $sect;
if ($_GET['sect']) {
		$sect = $_GET['sect'];
} else { $sect = "0"; 
 } 
}

// Admin Nav

function adminnav($sel_section, $sel_page, $public = false){
	  $output = "<ul class=\"clsUnorderedBody\">";
//Performing query - query in functions.php			
			$section_set = get_all_sections($public);						
//Use returned data
   while($section = mysql_fetch_array($section_set)){
   $output .= "<li><a href=\"edit_section.php?sect=" . urlencode($section["id"]) .
			"\"";
			if($section["id"] == $sel_section['id']){$output .= " class=\"selected\"";}
			$output .= ">Edit {$section["menu_name"]}</a>";
							
//Performing query - query in functions.php		
			$page_set = get_pages_for_section($section["id"], $public);
      //Use returned data
   if (mysql_num_rows($page_set) > 0 ){
   $output .= "<ul>";
   while($page = mysql_fetch_array($page_set)) {
   $output .= "<li><a href=\"content.php?page=" . urlencode($page["id"]) . "\"";
			if($page["id"] == $sel_page['id']){$output .= " class=\"selected\"";}
			$output .= ">Edit {$page["menu_name"]}</a></li>";     
        } 
   $output .= "</ul>";
			} else { 
			$output .= "</li>";
      }
			}
   $output .= "</ul>";
			return $output;
	}

// Public Nav


function public_navigation($sel_section, $sel_page, $public = true){
	      $output = "<ul class=\"clsPrimaryNavItems\">";
      //Perform query
       $section_set = get_all_sections($public);
      //Use returned data
       while($section = mysql_fetch_array($section_set)){
       $output .= "<li><a href=\"index.php?sect=" . urlencode($section["id"]) . "\"";
							if($section["id"] == $sel_section['id']){$output .= " class=\"clsSelected\"";}
							$output .= ">{$section["menu_name"]}</a>";
						
       $page_set = get_pages_for_section($section["id"], $public);

      //Use returned data
						if (mysql_num_rows($page_set) > 1 ){
       $output .= "<ul>";
       while($page = mysql_fetch_array($page_set)) {							
       $output .= "<li><a href=\"index.php?page=" . urlencode($page["id"]) . "&amp;sect=" . urlencode($section["id"]) . "\">{$page["menu_name"]}</a></li>";     
     } 
      $output .= "</ul>";
						} else { 
						$output .= "</li>";
}
							}
      $output .= "</ul>";
						return $output;
	}


?>