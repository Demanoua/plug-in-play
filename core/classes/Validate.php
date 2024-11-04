<?php 

	class Validate{

		public static function escape($input){
			$input = trim(strip_tags($input));
			$input = stripslashes($input);
			$input = htmlentities($input, ENT_QUOTES);
			// $input = htmlspecialchars($input, ENT_QUOTES);
			return $input;
		}		
		
		public static function revers_escape($input){
			$input = htmlspecialchars_decode($input);
			$input = html_entity_decode($input);
			return $input;
		}

        public static function filterEmail($email){
			return filter_var($email, FILTER_VALIDATE_EMAIL);
		}

		public static function length($input, $min, $max){
			if(strlen($input) > $max){
				return true;
			}else if(strlen($input) < $min){
				return true;
			}
		}

    }