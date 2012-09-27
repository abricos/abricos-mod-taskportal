<?php 
/**
 * @version $Id$
 * @package Abricos
 * @subpackage TaskPortal
 * @copyright Copyright (C) 2012 Abricos. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @author Alexander Kuzmin <roosit@abricos.org>
 */


/**
 * Модуль-сборка "Интернет-магазин"
 */
class TaskPortalModule extends Ab_Module {
	
	/**
	 * Конструктор
	 */
	public function __construct(){
		$this->version = "0.1.1";
		$this->name = "taskportal";
	}

}

Abricos::ModuleRegister(new TaskPortalModule())

?>