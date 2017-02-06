<?php

  // is_blank('abcd')
  function is_blank($value='') {
    if(strlen($value) == 0 || strlen($value) == NULL)
        return 1;
    return 0;
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
//return 1 if the value meets length requirements
  function has_length($value, $options=array()) {
      //for first/last name [1,256]
      //for username [7, 256]
    if(strlen($value) > $options[0] && strlen($value) < $options[1]) {
        return 1;
    }
      return 0;
  }

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
        if(strpos($value, '@') !== false)
            return 1;
        return 0;
  }
?>
