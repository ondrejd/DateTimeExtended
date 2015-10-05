<?php
/**
 * DateTimeExtended
 *
 * @author Ondrej Donek, <ondrejd@gmail.com>
 * @license Mozilla Public License 2.0 https://www.mozilla.org/MPL/2.0/
 */

/**
 * Class for calculating next working day.
 *
 * @author Ondřej Doněk, <ondrejd@gmail.com>
 * @link http://php.net/manual/en/class.datetime.php
 */
class DateTimeExtended extends DateTime
{

	/**
	 * Constructor.
	 * 
	 * @link http://php.net/manual/en/datetime.construct.php
	 * @param mixed $time (Optional.)
	 * @param DateTimeZone $timezone (Optional.)
	 * @return void
	 */
	public function __construct($time = 'now', $timezone = null)
	{
		parent::__construct($time, $timezone);
	}

	/**
	 * Checks if date is a working day.
	 *
	 * @return boolean
	 */
	public function isWorkingDay()
	{
		//$time = strtotime($this->date);

		if (in_array(date('D', $this->getTimestamp()), array('Sat', 'Sun'))) {
			return false;
		}

		$holidays = array_keys($this->getCzechAllHolidays());

		if (in_array(date('m-d', $this->getTimestamp()), $holidays)) {
			return false;
		}

		return true;
	}

	/**
	 * Retrieve next working day.
	 * 
	 * @return DateTime
	 */
	public function getNextWorkingDay()
	{
		$date = clone $this;
		$date->add(new DateInterval('P1D'));

		while ($date->isWorkingDay() !== true) {
			$date->add(new DateInterval('P1D'));
		}

		return $date;
	}

	/**
	 * Retrieve array with all Czech holidays.
	 *
	 * @link http://www.mpsv.cz/cs/74
	 * @return array
	 */
	public function getCzechAllHolidays()
	{
		return array_merge(
			$this->getCzechBankHolidays(),
			$this->getCzechPublicHolidays()
		);
	}

	/**
	 * Retrieve array with all Czech bank holidays.
	 *
	 * @link http://www.mpsv.cz/cs/74
	 * @return array
	 */
	public function getCzechBankHolidays()
	{
		// TODO Pokud je `$date` mensi nez 10. února 2004, tak "Den vítězství"
		//      je "Den osvobození".
		return array(
			'01-01' => 'Den obnovy samostatného českého státu',
			'05-08' => 'Den vítězství',
			'07-05' => 'Den slovanských věrozvěstů Cyrila a Metoděje',
			'07-06' => 'Den upálení mistra Jana Husa',
			'09-28' => 'Den české státnosti',
			'10-28' => 'Den vzniku samostatného československého státu',
			'11-17' => 'Den boje za svobodu a demokracii',
		);
	}

	/**
	 * Retrieve array with public holidays.
	 *
	 * @link http://www.mpsv.cz/cs/74
	 * @return array
	 */
	public function getCzechPublicHolidays()
	{
		$year = date('Y', $this->getTimestamp());
		$base = new DateTime(date('Y-m-d', easter_date($year)));
		$base->add(new DateInterval('P1D'));
		$easter = $base->format('m-d');

		return array(
			'01-01' => 'Nový rok',
			$easter => 'Velikonoční pondělí',
			'05-01' => 'Svátek práce',
			'12-24' => 'Štědrý den',
			'12-25' => '1. svátek vánoční',
			'12-26' => '2. svátek vánoční',
		);
	}
}
