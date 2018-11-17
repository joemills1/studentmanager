<?php 

//FUNCTIONS.php


// clean the form data to prevent injection
function validateFormData($formData){

  $formData = trim( 
      stripslashes( 
          htmlspecialchars( 
              strip_tags ( 
                  str_replace( array( '(',')' ), '', $formData) ), ENT_QUOTES ) ) );

  return $formData;

}  

// hash user enter password before saving in db
function encryptUserPassword($userPassword){
    
    $hashedPassword = password_hash( $userPassword, PASSWORD_DEFAULT);
    return $hashedPassword;
    
}

// check password entered against hashed password
// in db upon login
function verifyUserPassword($enteredPassword, $hashedPassword){
    
    if( password_verify($enteredPassword, $hashedPassword) ){
        return true;
    }
    
    return false;
    
}



?>