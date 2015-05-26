<?php namespace App\Http\Model;

use DB;

class UserModel
{
	public static function findUser($nId)
	{
		$sSql = "SELECT * FROM `users` WHERE `id` = " . $nId;
		$aRs = DB::select($sSql);
		return $aRs[0];
	}
}