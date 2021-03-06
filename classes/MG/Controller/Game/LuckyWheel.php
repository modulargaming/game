<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Controller for Game LuckyWheel
 *
 * @package    MG/Game
 * @category   Controller
 * @author     Modular Gaming
 * @copyright  (c) 2013 Modular Gaming
 * @license    BSD http://www.modulargaming.com/license
 */
class MG_Controller_Game_LuckyWheel extends Abstract_Controller_Game {

	protected $game_id = 2;
	protected $price = 100;
	protected $max_plays = 1;
	protected $play_timeout = Date::HOUR;
	protected $win_points = array(0, 0, 50, 50, 100, 100, 100, 200, 200, 500);
	protected $win_multiplier = 0.5;
	
	public function action_index()
	{
		$this->view = new View_Game_LuckyWheel;
		$can_play = $this->can_play();
		$this->view->can_play = $can_play;
		$this->view->has_price = $this->user->get_property('points') >= $this->price;
		if ($this->request->method() == HTTP_Request::POST)
		{
			try
			{
				$post = $this->request->post();
				if (isset($post['collect']) AND $this->game->winnings)
				{
					$this->game->collect_winnings(FALSE);
					Hint::success('You have collected your winnings');
					$this->redirect(Route::url('games.lucky-wheel'));
				}
				if ($can_play)
				{
					$play = $this->play($this->game);
					$this->view->play = $play;
				}
			}
			catch (ORM_Validation_Exception $e)
			{
				Hint::error($e->errors('models'));
			}
		}
		$this->view->game = $this->game;
	}

	private function play($game)
	{
		$win = round($game->winnings * $this->win_multiplier + $this->win_points[mt_rand(0, count($this->win_points)-1)]);
		$this->play_game($win);
		return array('win' => $win);
	}
}
