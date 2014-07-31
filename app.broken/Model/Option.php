<?php

class Option extends AppModel
{
   var $hasAndBelongsToMany='Device';
   var $displayField='option_name';
}

?>
