<?php
include "database.php";

require_once 'CategoryHierarchy.php';


if ($result = mysqli_query($conn, "SELECT * FROM abc")) {
 // echo "Returned rows are: " . $result -> num_rows;
}


while($row = mysqli_fetch_array($result)) {
	/*echo "<tr>";
		echo "<td>" . $row['id'] . "</td>";
		echo "<td>" . $row['value'] . "</td>";
	echo "</tr>";*/
	$val = $row['value'];
}
		
/*echo '<pre>';
print_r(unserialize($val));exit;
*///$tree = json_decode( $val, true );

$conn -> close();

$tree	= new CategoryHierarchy();

$tree->setupItems(unserialize($val));
$tree_js	= $tree->render();

print_r($tree_js);
exit;
?>

<script type="module">
	import { ui } from 'ui.js';
	import { subscribe, updateTree, updateSecretURL } from 'framework.js';
	const tree = <?php echo $tree_js; ?>;
	const url = 'null';
	subscribe( ( newTree, newURL, newExpanded ) => ui( newTree, newURL, newExpanded, document.getElementById( 'ui' ) ) );
	updateTree( tree );
	updateSecretURL( url );
</script>

<div id="ui">
	
	</div>



