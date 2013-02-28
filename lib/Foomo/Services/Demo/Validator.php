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
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar jan@bestbytes.com
 */
class Validator
{
	/**
	 * validates a city on an address and emits RPC service messages
	 * 
	 * @param Vo\Address $address
	 */
	public static function validateCity($address)
	{
		$address = (object) $address;
		$comment = '';
		$valid = false;
		switch(true) {
			case empty($address->city):
				$comment = 'I want to know from which city you are coming from!';
				$valid = false;
				break;
			case !empty($address->city):
				if($address->city == 'Munich') {
					$comment = 'That is where i come from ;)';
				} else {
					$comment = $address->city . ' - is that a nice place to live?';
				}
				$valid = true;
				break;
		}
		if(!empty($comment)) {
			\Foomo\Services\RPC::addMessage(Vo\AddressFieldFeedback::getFeedback('city', $valid, $comment));
		}
		return $valid;
	}
	/**
	 * is a field on an object or array filled in
	 * 
	 * @param mixed $vo object or array
	 * @param string $fieldName
	 * 
	 * @return boolean 
	 */
	public static function isFieldFilledIn($vo, $fieldName)
	{
		$vo = (object) $vo;
		if(empty($vo->$fieldName)) {
			$feedbackMessageObject = Vo\AddressFieldFeedback::getFeedback(
				$fieldName, 
				false, 
				$fieldName . ' must not be empty'
			);
			\Foomo\Services\RPC::addMessage($feedbackMessageObject);
			return false;
		} else {
			return true;
		}
	}
}