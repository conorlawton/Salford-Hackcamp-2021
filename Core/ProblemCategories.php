<?php
	
	
	class ProblemCategories
	{
		static function get_category_name_by_id(int $id): string {
			switch($id) {
				case 1:
					return "Password Queries";
				case 2:
					return "Login Issues";
				case 3:
					return "Process Queries";
				case 4:
					return "Transfers in";
				case 5:
					return "Withdrawals";
				case 6:
					return "Benefits";
				case 7:
					return "New Business Applications";
				case 8:
					return "Complaints";
			}
		}
	}