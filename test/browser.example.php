<?php

require 'browser.class.php';

/**
 * The long way to the PHP Reference Manual...
 */

/**
 * New browser object
 * User agent string is not compulsory usually,
 *  but Wikipedia sends us a 402 if we don't
 * Thanks Richard Williams
 */
$b = new Browser ( 'PHP Browser' );

/**
 * Navigate to the first url
 */
$b -> navigate ( 'http://myanimelist.net/anime/16742/Watashi_ga_Motenai_no_wa_Dou_Kangaetemo_Omaera_ga_Warui!' );

echo $b -> getSource(); // Output the source
