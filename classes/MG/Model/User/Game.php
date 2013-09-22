<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Model for User Game
 *
 * @package    MG/Game
 * @category   Model
 * @author     Modular Gaming
 * @copyright  (c) 2013 Modular Gaming
 * @license    BSD http://www.modulargaming.com/license
 */
class MG_Model_User_Game extends ORM
{

	protected $_table_columns = array(
		'id'          => NULL,
		'game_id'     => NULL,
		'user_id'     => NULL,
		'plays'       => NULL,
		'last_play'   => NULL,
		'winnings'      => NULL
	);

	protected $_belongs_to = array(
		'user' => array(
			'model' => 'User',
		)
	);

	public function can_play($max_plays, $play_timeout)
	{
		if ($this->plays >= $max_plays)
		{
			if ($this->last_play > time() - $play_timeout)
			{
				return FALSE;
			}
			else
			{
				$this->plays = 0;
				$this->save();
			}
		}
		return TRUE;
	}

	public function collect_winnings($play)
	{
		$this->user->set_property('points', $this->user->get_property('points') + $this->winnings);
		$this->user->save();
		$this->winnings = 0;
		if ($play)
		{
			$this->plays ++;
			$this->last_play = time();
		}
		$this->save();
	}

	public function create_game($values, $expected)
	{
		return $this->values($values, $expected)
			->create();
	}



} // End Game Model
