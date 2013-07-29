<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * View for Game Index
 *
 * @package    MG/Game
 * @category   View
 * @author     Modular Gaming
 * @copyright  (c) 2013 Modular Gaming
 * @license    BSD http://www.modulargaming.com/license
 */
class MG_View_Game_Index extends Abstract_View_Game {

	public $title = 'Games';

	public function links()
	{
		return array(
			'rockpaperscissors' => Route::url('games.rock-paper-scissors'),
			'luckywheel' => Route::url('games.lucky-wheel')
		);
	}

}
