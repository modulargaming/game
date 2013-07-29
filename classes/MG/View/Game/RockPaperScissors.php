<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * View for Game RockPaperScissors
 *
 * @package    MG/Game 
 * @category   View
 * @author     Modular Gaming Team
 * @copyright  (c) 2013 Modular Gaming Team
 * @license    BSD http://modulargaming.com/license
 */
class MG_View_Game_RockPaperScissors extends Abstract_View_Game {

	public $title = 'Rock Paper Scissors';

	public function get_breadcrumb()
	{
		return array_merge(parent::get_breadcrumb(), array(
			array(
				'title' => 'Rock Paper Scissors',
				'href'  => Route::url('games.rock-paper-scissors'
			))
		));
	}

	public function game()
	{
		return array(
			'plays'     => $this->game->plays,
			'last_play' => ($this->game->last_play ? Date::format($this->game->last_play) : 'Never'),
			'winnings'  => number_format($this->game->winnings)
		);
	}

}
