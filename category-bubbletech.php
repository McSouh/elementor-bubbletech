<?php

// Create and ReOrder Widgets Categories
add_action( 'elementor/elements/categories_registered', function(\Elementor\Elements_Manager $elements_manager ) {

	$name = "bubbletech";
	//add our categories
	$elements_manager->add_category(
		$name,
		[
			'title' => 'BubbleTech',
			'icon' => 'fa fa-plug',
		]
	);

	//hack into the private $categories member, and reorder it so our stuff is at the top

	$reorder_cats = function() use($name){
		uksort($this->categories, function($keyOne, $keyTwo) use($name){
			if(substr($keyOne, 0, 10) == $name){
				return -1;
			}
			if(substr($keyTwo, 0, 10) == $name){
				return 1;
			}
			return 0;
		});

	};
	$reorder_cats->call($elements_manager);

} );