function update_records($dbc, $status, $item_name, $description, $location_id, $room, $contact_name, $email, $phone_number, $id) {
  $query = 'UPDATE stuff SET status = " '. $status . ' " , 
           					 item_name = "' . $item_name . '" , 
            				 description = "' . $description . '" , 
           					 location_id = "' . $location_id . '" , 
            				 room = "' . $room . '" ,  
           					 contact_name = "' . $contact_name . '" ,  
           					 email = "' . $email . ' " , 
           					 phone_number = "' . $phone_number . ' " 
           					 WHERE id = ' $id ' ';
  
  show_query($query);
  
  
  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;

  return $results ;
}
