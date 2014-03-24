<?php
/**
 * import_themes.php
 * 
 * Creates a backup of the current themes in ./theme_bak_YYYY_MM_DD.gz, then
 * imports all theme (xml) files in this directory.
 * 
 * If an error occurs, it should be possible to revert the changes by 
 * overwriting /cache/themes with the contents of a backup, then using myBB's 
 * "Export Theme" function to replace the theme(s) causing the problem.
 */
if(php_sapi_name() != 'cli') { //Prevent access other than by command line
	die('This file may not be loaded via web!');
}

define('IN_MYBB', 1); //Otherwise included scripts think we are a hacker and 
					  //generate errors

require_once('../global.php');
require_once('../admin/inc/functions.php');
require_once('../admin/inc/functions_themes.php');

$importOptions = array(
	'no_stylesheets' => false, //Do import style sheets
	'no_templates' => false, //Do import templates
	'version_compat' => false, //Ignore version checking
	'parent' => 1, //1 => The MyBB master style
	'force_name_check' => false, //Do not fail if the theme already exists
);

$templateFileNames = glob('*.xml');

foreach($templateFileNames as $curFileName) {
	echo "Importing $curFileName...";
	$importResult = import_theme_xml(
		file_get_contents($curFileName), 
		$importOptions
	);
	
	if($importResult < 1) {
		handleImportError($importResult, $curFileName);
	} else {
		echo "Success - template imported with ID $importResult";
	}
	echo "\n";
}

echo 'Done';

/**
 * Handler for the output of import_theme_xml
 */
function handleImportError($result, $fileName) {
	switch($result) {
		case -1:
			echo "Error: file $fileName was empty or was not opened correctly.";
			break;
		// -2 and -3 are only generated if force_name_check or version_compat
		// are true.
		case -4:
			echo "Error: A security problem was detected in $fileName.";
		default:
			echo "Error: Unexpected result '$result' returned by "
				. "import_theme_xml for $fileName!";
	}
}