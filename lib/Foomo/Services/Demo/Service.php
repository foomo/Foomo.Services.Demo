<?php

/*
 * This file is part of the foomo Opensource Framework.
 * 
 * The foomo Opensource Framework is free software: you can redistribute it
 * and/or modify it under the terms of the GNU Lesser General Public License as
 * published  by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 * 
 * The foomo Opensource Framework is distributed in the hope that it will
 * be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public License along with
 * the foomo Opensource Framework. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Foomo\Services\Demo;
 
/**
 * a demonstration web service
 * 
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar jan@bestbytes.com
 */
class Service
{
	const VERSION = 0.1;
	/**
	 * get the server time
	 * 
	 * @return int unix timstamp in seconds
	 */
	public function getTime()
	{
		return time();
	}
	/**
	 * add two numbers
	 * 
	 * @param float $a
	 * @param float $b 
	 * 
	 * @return float
	 * 
	 * @throws Foomo\Services\Demo\Exception
	 */
	public function add($a, $b)
	{
		$res = $a + $b;
		if($res < 100) {
			throw new Exception(
				sprintf(Module::getTranslation($this)->_('MSG_TOO_SIMPLE'), $a, $b),
				Exception::CODE_TOO_SIMPLE
			);
		}
		return $a + $b;
	}
	/**
	 * @serviceGen ignore 
	 */
	public function hiddenFoo()
	{
		
	}
	/**
	 * validate an address
	 * 
	 * @param Foomo\Services\Demo\Vo\Address $address 
	 * 
	 * @return bool
	 * 
	 * @serviceMessage Foomo\Services\Demo\Vo\AddressFieldFeedback
	 */
	public function validateAddress($address)
	{
		$cityValid = Validator::validateCity($address);
		$zipValid = Validator::isFieldFilledIn($address, 'zip');
		$countryValid = Validator::isFieldFilledIn($address, 'country');
		return $cityValid && $zipValid && $countryValid;
	}
}