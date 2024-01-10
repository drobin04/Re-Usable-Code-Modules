<?php 

function selectquery($dbpath, $sql) {
	debuglog($sql,"about to execute query");
	$db_file = new PDO($dbpath);
	$dsn = 'sqlite:' . $dbpath;
	$db_file = new PDO($dsn);
	$stmt1 = $db_file->prepare($sql);
	$stmt1->execute();
	$results = $stmt1->fetchAll(PDO::FETCH_ASSOC);
	//debuglog($results,"Query results");
	return $results;
}
function scalarquery($dbpath,$sql, $columnname) {
	debuglog($sql,"about to execute scalar query");
	$db_file = new PDO($dbpath);
	$stmt1 = $db_file->prepare($sql);
	$stmt1->execute();
	$results = $stmt1->fetchAll(PDO::FETCH_ASSOC);
	return $results[0][$columnname];
}
function scalarquery_bind1($dbpath, $sql, $boundParam, $columnname) {
	$db_file = new PDO($dbpath);
	$stmt1 = $db_file->prepare($sql);
	$stmt1->bindParam(1,$boundParam,PDO::PARAM_STR);
	$stmt1->execute();
	$results = $stmt1->fetchAll(PDO::FETCH_ASSOC);
	return $results[0][$columnname];
}


function execquery($localdb, $sql) {
	$stmt1 = $localdb->prepare($sql);
	$stmt1->execute();
	
}

/**
 * Function to generate HTML table from array of objects
 *
 * @param array $data
 * @return string
 */
function generateTableFromObjects(array $data): string {
    if (empty($data)) {
        return '<p>No data available</p>';
    }

    $html = '<table class="TableResults">';
    $html .= '<tr>';
    foreach ($data[0] as $key => $value) {
        $html .= '<th>' . htmlspecialchars($key) . '</th>';
    }
    $html .= '</tr>';

    foreach ($data as $row) {
        $html .= '<tr>';
        foreach ($row as $value) {
            $html .= '<td>' . htmlspecialchars($value) . '</td>';
        }
        $html .= '</tr>';
    }

    $html .= '</table>';

    return $html;
}

function GUID()
{
	if (function_exists('com_create_guid') === true)
	{
		return trim(com_create_guid(), '{}');
	}

	return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}
function debuglog( $object=null, $label=null ){
	// DEBUG LOGGING
	// SET THE BELOW TO TRUE IF YOU WANT DEBUGGING INFO TO APPEAR IN CONSOLE OF WEBPAGES
	// HOWEVER THIS BLOATS THE TRANSFERRED DATA ON PAGES AND IS PREFERRABLY LEFT OFF FOR BETTER PERFORMANCE WHILE LIVE. 
	$debug_logging_enabled = false;
	
	$message = json_encode($object, JSON_PRETTY_PRINT);
	$label = "Debug" . ($label ? " ($label): " : ': ');
	if ($debug_logging_enabled) {
		echo "<script>console.log(\"$label\", $message);</script>";
	}
}

function redirect($url) {
    $currentUrl = $_SERVER['REQUEST_URI'];
    $baseUrl = rtrim(dirname($currentUrl), '/');
    $absoluteUrl = $baseUrl . '/' . ltrim($url, '/');
	//echo '<script>alert("redirecting!");</script>';
    echo "<script>location.href = '". $absoluteUrl ."';</script>";
}

?>
