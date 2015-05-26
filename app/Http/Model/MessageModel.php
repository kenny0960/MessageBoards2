<?php namespace App\Http\Model;

use DB;

class MessageModel
{
	public static function getAllMessages()
	{
		$sSql = "SELECT * FROM `messages` ORDER BY `id` DESC";
		$aRs = DB::select($sSql);
		return $aRs;
	}

	public static function findMessage($nId)
	{
		$sSql = "SELECT * FROM `messages` WHERE `id` = " . $nId;
		$aRs = DB::select($sSql);
		return $aRs[0];
	}

	public static function addMessage($sTitle, $sBody, $nUserId)
	{
		if (empty($sTitle) || empty($sBody) || empty($nUserId)) {
			return false;
		}
		$sSql = sprintf("
			INSERT INTO `messages` (`title`,`body`,`user_id`,`created_at`,`updated_at`)
			VALUES ('%s','%s',%u, NOW(), NOW())"
			, addslashes($sTitle), addslashes($sBody), $nUserId);
		$bRs = DB::insert($sSql);
		return $bRs;
	}

	public static function updMessage($sTitle, $sBody, $nUserId, $nId)
	{
		if (empty($sTitle) || empty($sBody) || empty($nUserId)) {
			return false;
		}
		$sSql = sprintf("
			UPDATE `messages` SET `title` = '%s',`body` = '%s',`user_id` = %u, `updated_at` = NOW()
			WHERE `id` = %u"
			, addslashes($sTitle), addslashes($sBody), $nUserId, $nId);
		$bRs = DB::update($sSql);
		return $bRs;
	}

	public static function delMessage($nId)
	{
		$sSql = "DELETE FROM `messages` WHERE `id` = " . $nId;
		$bRs = DB::delete($sSql);
		return $bRs;
	}
}
