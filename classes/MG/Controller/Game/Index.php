<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Controller for Game Index
 *
 * @package    MG/Game
 * @category   Controller
 * @author     Modular Gaming
 * @copyright  (c) 2013 Modular Gaming
 * @license    BSD http://www.modulargaming.com/license
 */
class MG_Controller_Game_Index extends Abstract_Controller_Game {

	public function action_index()
	{
		$this->view = new View_Game_Index;
	}


}
