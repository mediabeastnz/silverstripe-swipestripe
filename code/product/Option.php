<?php
/**
 * Represents an Option for an Attribute, e.g: Small, Medium, Large, Red etc.
 * Default Options can be created for Attributes, they are pre populated and duplicated into the Product
 * when the Attribute is added to a Product. Options can be changed for each Product. 
 * Default Options will have a ProductID of 0.
 * 
 * @author Frank Mullenger <frankmullenger@gmail.com>
 * @copyright Copyright (c) 2011, Frank Mullenger
 * @package swipestripe
 * @subpackage product
 */
class Option extends DataObject {

	public static $singular_name = 'Option';
	public static $plural_name = 'Options';

	/**
	 * DB fields for this Option
	 * 
	 * @var Array
	 */
	public static $db = array(
		'Title' => 'Varchar(255)',
		'Description' => 'Text',
		'SortOrder' => 'Int'
	);

	/**
	 * Has one relations for an Option
	 * 
	 * @var Array
	 */
	public static $has_one = array(
		'Attribute' => 'Attribute',
		'Product' => 'Product'
	);
	
	/**
	 * Belongs many many relations for an Option
	 * 
	 * @var Array
	 */
	static $belongs_many_many = array(    
		'Variations' => 'Variation'
	);

	public static $default_sort = 'SortOrder';

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName('Variations');
		$fields->removeByName('ProductID');
		$fields->removeByName('AttributeID');
		$fields->removeByName('SortOrder');
		return $fields;
	}

}

class Option_Default extends Option {

	public static $singular_name = 'Option';
	public static $plural_name = 'Options';

	public function onBeforeWrite() {
		parent::onBeforeWrite();
		$this->ProductID = 0;
	}
}