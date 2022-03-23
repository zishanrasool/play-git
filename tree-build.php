<?php
 sgit session_status

//https://www.sitepoint.com/community/t/tree-building-challenge/68361/7
 
/**
 * Turn data into a tree node
 * @param array $data
 * @return array An array 'name', 'title' and 'class' in the key 'attributes' and an empty array in the key 'children' -- to add children to later
 */
function createNode($data)
{
	return
		array(
			'attributes' => array(
				'name'=>$data['name'],
				'title'=>$data['title'],
				'class'=>$data['class']
			),
			'children'=>array()
		);
}

/**
 * Add children to a node
 * @param int $i The recordid of the node to add the children to
 * @param array $tree The initial tree to start growing
 * @param array $childrenOf Array that holds children
 * @param <type> $hasChildren Array that indicates which node has children
 * @return array The tree with the needed children added
 */
function addChildren($i, $tree, $childrenOf, $hasChildren)
{
	// If the node with recordid $i has children ...
	if (isset($hasChildren[ $i ])) {
		// .. loop through those children
		foreach($childrenOf[ $i ] as $child){
			// find the recordid of the children
			$recordid=$child['recordid'];
			// and add the children's children
			$tree['children'][ $child['recordid'] ] = addChildren($recordid, createNode($child), $childrenOf, $hasChildren);
		}
	}
	return $tree;
}

$hasChildren = array();
$childrenOf = array();


foreach($data as $k=>$v)
{
	// Determine if this is a child node or the root node
	if ($v['parentid'] > 0)
	{
		// It's a child node
		$childrenOf[ $v['parentid'] ][] = $v;
		$hasChildren[ $v['parentid'] ] = true;
	}
	else
	{
		// It's the root node
		$root_record_id=$v['recordid'];
		$root=createNode($v);
	}
}

// Create the tree and show it
print_r(array($root_record_id => addChildren($root_record_id, $root, $childrenOf, $hasChildren)));