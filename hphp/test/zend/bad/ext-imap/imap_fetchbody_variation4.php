<?php
/* Prototype  : string imap_fetchbody(resource $stream_id, int $msg_no, string $section [, int $options])
 * Description: Get a specific body section 
 * Source code: ext/imap/php_imap.c
 */

/*
 * Test if FT_UID is set by passing the following as $options argument to imap_fetchbody():
 * 1. values that equate to 1
 * 2. Minimum and maximum PHP values
 */
echo "*** Testing imap_fetchbody() : usage variations ***\n";

require_once(dirname(__FILE__).'/imap_include.inc');

// Initialise required variables
$stream_id = setup_test_mailbox('', 1); // set up temporary mailbox with one simple message
$msg_no = 1;
$msg_uid = imap_uid($stream_id, $msg_no);
$section = 1;

//Note: the first four values are valid as they will all be cast to 1L.
$options = array ('1', true, 
                  1.000000000000001, 0.00001e5, 
                  PHP_INT_MAX, -PHP_INT_MAX);

// iterate over each element of $options array to test whether FT_UID is set
$iterator = 1;
imap_check($stream_id);
foreach($options as $option) {
	echo "\n-- Iteration $iterator --\n";
	if(is_string(imap_fetchbody($stream_id, $msg_uid, $section, $option))) {
		echo "FT_UID valid\n";
	} else {
                echo "FT_UID not valid\n";
        }
	$iterator++;
}

?>
===DONE===?>
<?php
require_once(dirname(__FILE__).'/clean.inc');
?>