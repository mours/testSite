<?php

$themename = "Illuminated";
$shortname = "illum";
function wpguy_initial_cap($content){ 
    // Regular Expression, matches a single letter
    // * even if it's inside a link tag.
    $searchfor = '/(<a [^>]+>)?([^<s])/';
    // The string we're replacing the letter for
    $replacewith = '$1<span class="initialcap">$2</span>';
    // Replace it, but just once (for the very first letter of the post)
    $content = preg_replace($searchfor, $replacewith, $content, 1);
    // Return the result
    return $content;
}

function __autoload($class_name) {
    include 'model/'.$class_name . '.class.php';
}

function secure($content)
{
    return addslashes(htmlspecialchars($content));
}

// returns HTML link to Mappy itinerary.
function mappyLink( $address )
{
    // replace blank spaces by + char.
    $address1 = str_replace( " ", "+", htmlspecialchars( $address." France" ) );
    // destination address.
    $address2 = "62 rue de Chalaire 26540 Mours Saint Eusèbe France";
    $address2 = str_replace( " ", "+", htmlspecialchars( $address2 ) );
    // create Mappy link.
    $link = "http://fr.mappy.com/#d[]=".$address1."&d[]=".$address2."&endPos[y]=45.068826&endPos[x]=5.040714&ipo=1&lm=r&p=itinerary";
    return $link;
}

?>