<?php
  include("config/connect.php");
// Item data
//This code first filters the items based on the user preference by checking 
//if the preference attributes appear in the item attributes. 
//It then sorts the filtered items by their relevance to the user using the similar_text 
//function to compare the title and category of each item to the user preference. 
//Finally, it selects the most relevant item as the recommended item and displays its title.
$mainID = htmlspecialchars($_REQUEST['main_id']); 
echo $query =" SELECT program_name FROM responded_program WHERE assessment_id=$mainID ORDER BY program_name";
$rst = mysqli_query($con, $query);
if (mysqli_num_rows($rst)!=0){
    while ( $row = $rst->fetch_assoc() ) {
       echo  $project_title=$row['program_name']."<br>";
       // $userPreference = ['title' => $project_title, 'category' => 'Computer'];
    }
    //$row = mysqli_fetch_row($rst);
   //$project_title = $row[0]; //mysqli_result($rows,0,"program_name");
}   

$userPreference = ['title' => $project_title, 'category' => 'Computer'];

$items = [
    ['id' => 1, 'title' => 'INTRODUCTION TO BASIC COMPUTER', 'category' => 'COMPUTER', 'description' => 'INTRODUCTION TO BASIC COMPUTER'],
    ['id' => 2, 'title' => 'TRANSCEDING EXCELLENCE THROUGH COMPUTER', 'category' => 'COMPUTER', 'description' => 'TRANSCEDING EXCELLENCE THROUGH COMPUTER'],
    ['id' => 3, 'title' => 'COMPUTER and MICROSOFT ADVANCE LEARNING', 'category' => 'COMPUTER', 'description' => 'COMPUTER and MICROSOFT ADVANCE LEARNING'],
    ['id' => 4, 'title' => 'BASIC KNOWLEDGE IN MICROSOFT OFFICE', 'category' => 'MICROSOFT OFFICE', 'description' => 'BASIC KNOWLEDGE IN MICROSOFT OFFICE'],
    ['id' => 5, 'title' => 'INTRODUCTION TO BASIC MICROSOFT OFFICE', 'category' => 'MICROSOFT OFFICE', 'description' => 'INTRODUCTION TO BASIC MICROSOFT OFFICE'],
    ['id' => 6, 'title' => 'CREATING A WEBPAGE USING HTML', 'category' => 'Programming', 'description' => 'CREATING A WEBPAGE USING HTML'],
    //['id' => 4, 'title' => 'Item 4', 'category' => 'Category 2', 'description' => 'Description 4'],
];

//var_dump($_REQUEST);
// User preference////
//$userPreference = ['title' => $project_title, 'category' => 'Computer'];
/*$userPreference = [
    'title' => 'INTRODUCTION TO BASIC COMPUTER', 'category' => 'Computer',
    'title' => 'COMPUTER and MICROSOFT ADVANCE LEARNING', 'category' => 'Computer',
    'title' => 'INTRODUCTION TO BASIC COMPUTER', 'category' => 'Computer',
];*/
/*$userPreference = [
    'title' => 'INTRODUCTION TO BASIC COMPUTER', 'category' => 'Computer',
    'title' => 'COMPUTER and MICROSOFT ADVANCE LEARNING', 'category' => 'Computer',
    'title' => 'CREATING A WEBPAGE USING HTML', 'category' => 'Programming'
];*/


/*$userPreference = [
    ['title' => 'INTRODUCTION TO BASIC COMPUTER', 'category' => 'BASIC COMPUTER'],
    ['title' => 'TRANSCEDING EXCELLENCE THROUGH COMPUTE', 'category' => 'COMPUTER'],
    ['title' => 'COMPUTER and MICROSOFT ADVANCE LEARNING', 'category' => 'COMPUTER'],
    ['title' => 'BASIC KNOWLEDGE IN MICROSOFT OFFICE', 'category' => 'MICROSOFT OFFICE'],
    ['title' => 'INTRODUCTION TO BASIC MICROSOFT OFFICE', 'category' => 'MICROSOFT OFFICE'],
    ['title' => 'CREATING A WEBPAGE USING HTM', 'category' => 'WEBPAGE USING HTML'],
    
]; */
//echo $userPreference;

// Filter items based on user preference
$filteredItems = array_filter($items, function($item) use ($userPreference) {
    $itemAttributes = $item['title'] . ' ' . $item['category'] . ' ' . $item['description'];
    $preferenceAttributes = $userPreference['title'] . ' ' . $userPreference['category'];
    return strpos($itemAttributes, $preferenceAttributes) !== false;
});

// Sort items by relevance
usort($filteredItems, function($a, $b) use ($userPreference) {
    $aScore = similar_text($a['title'], $userPreference['title']) + similar_text($a['category'], $userPreference['category']);
    $bScore = similar_text($b['title'], $userPreference['title']) + similar_text($b['category'], $userPreference['category']);
    return $bScore - $aScore;
});

// Get recommended item
if (!empty($filteredItems)) {
    $recommendedItem = $filteredItems[0];
    $reco = "Recommended Category : " . $recommendedItem['title'];
} else {
    $reco = "No Recommended Program found";
    //$reco = $project_title;
}


?>