<?php
function getFlagImage($language) {
    // Define a map of language names to flag image directories
    $languageFlags = array(
        "French" => "france.png",
        "German" => "germanyy.png",
        "English" => "united-states.png",
        "Arabic" => "flag.png"
        // Add more language-flag mappings as needed
    );

    // Check if the provided language is in the map
    if (array_key_exists($language, $languageFlags)) {
        // Return the corresponding flag image directory
        return "images/" . $languageFlags[$language];
    } else {
        // If the language is not found, return a default flag image
        return "images/default-flag.png";
    }
}
?>