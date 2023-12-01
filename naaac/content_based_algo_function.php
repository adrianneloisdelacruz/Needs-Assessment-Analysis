<?php
function recommendContent($user_choices, $all_content) {
    $content_scores = array();
    
    // Loop through all content
    foreach ($all_content as $content_id => $content) {
      $content_score = 0;
      
      // Loop through user choices
      foreach ($user_choices as $choice) {
        // Check if user choice is in content
        if (stripos($content, $choice) !== false) {
          $content_score++;
        }
      }
      
      $content_scores[$content_id] = $content_score;
    }
    
    // Sort content by score in descending order
    arsort($content_scores);
    
    // Return top 5 recommended content
    return array_slice(array_keys($content_scores), 0, 5);
  }
  
?>