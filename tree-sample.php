<?php 

//https://stackoverflow.com/questions/29276699/php-too-slow-can-anyone-see-a-way-to-make-it-faster

// create_testcase.php
$handle = fopen("testcase.txt",'w');

for($i=0 ; $i < 10000 ; $i++){
    $number = rand(1,9999999999);
    fwrite($handle,$number."\n");
}
fclose($handle);

// unittest.php
class Node{
    private $digit;
    private $leaf = false;
    private $children = array();
    function __construct($digit,$leaf = false){
        $this->digit = $digit;
        $this->leaf = $leaf;
    }

    function isLeaf(){
        return $this->leaf;
    }

    function hasChild($digit){
        return array_key_exists($digit,$this->children);

    }

    function hasChildren(){
        return count($this->children);
    }

    function addChild($digit,$isLeaf){
        $this->children[$digit] = new Node($digit,$isLeaf);
        return $this->children[$digit];
    }

    function getChild($digit){
        return $this->children[$digit];
    }

}


for($i=0 ; $i < 40 ; $i++){

    $anchor = new Node(0,false);
    $isConsistent = true;
    $handle = fopen("testcase.txt",'r');

    while(($number = fgets($handle)) != false){
        $node = $anchor;
        $number = rtrim($number);
        $number_length = strlen($number);
        foreach(str_split($number) as $index => $digit){
            if($node->hasChild($digit)){
                $node = $node->getChild($digit);
                if($node->isLeaf()){
                    $isConsistent = false;
                    break;
                }
            }
            else{
                (($index+1) == $number_length) ? ($isLeaf = true) : ($isLeaf = false);
                $node = $node->addChild($digit,$isLeaf);
            }   
        }

        if($node->hasChildren()){
            $isConsistent = false;      
        }

        if(!$isConsistent){
            break;                  // don't continue to next number in test case
        }
    }
    if($isConsistent){
        print "Consist list<br>";

    }
    else{
        print "Not Consist list\n";
    }
    fclose($handle);

}
