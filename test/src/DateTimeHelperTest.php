<?php
/**
 * DateTimeExtended
 *
 * @author Ondrej Donek, <ondrejd@gmail.com>
 * @license Mozilla Public License 2.0 https://www.mozilla.org/MPL/2.0/
 */

/**
 * Tests for {@see DateTimeExtended} class.
 *
 * @author Ondřej Doněk, <ondrejd@gmail.com>
 */
class DateTimeExtendedTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @covers DateTimeExtended::isWorkingDay
	 */
	public function testIsWorkingDay()
	{
		$date1 = new DateTimeExtended('2015-09-28');
		$this->assertFalse($date1->isWorkingDay());

		$date2 = new DateTimeExtended('2015-09-29');
		$this->assertTrue($date2->isWorkingDay());

		$date3 = new DateTimeExtended('2015-04-04');
		$this->assertFalse($date3->isWorkingDay());

		$date4 = new DateTimeExtended('2010-04-05');
		$this->assertFalse($date4->isWorkingDay());

		$date5 = new DateTimeExtended('2008-03-24');
		$this->assertFalse($date5->isWorkingDay());

		$date6 = new DateTimeExtended('2004-04-12');
		$this->assertFalse($date6->isWorkingDay());
	}

	/**
	 * @covers DateTimeExtended::getNextWorkingDay
	 */
	public function testGetNextWorkingDayTest()
	{
		$date1 = new DateTimeExtended('2015-09-25');
		$this->assertEquals('2015-09-29', $date1->getNextWorkingDay()->format('Y-m-d'));

		$date2 = new DateTimeExtended('2015-10-02');
		$this->assertEquals('2015-10-05', $date2->getNextWorkingDay()->format('Y-m-d'));

		$date3 = new DateTimeExtended('2015-04-03');
		$this->assertEquals('2015-04-07', $date3->getNextWorkingDay()->format('Y-m-d'));

		$date4 = new DateTimeExtended('2010-04-02');
		$this->assertEquals('2010-04-06', $date4->getNextWorkingDay()->format('Y-m-d'));

		$date5 = new DateTimeExtended('2008-03-21');
		$this->assertEquals('2008-03-25', $date5->getNextWorkingDay()->format('Y-m-d'));

		$date6 = new DateTimeExtended('2004-04-09');
		$this->assertEquals('2004-04-13', $date6->getNextWorkingDay()->format('Y-m-d'));
	}
}