<?php namespace App\Http\Model;

use DB;

class CommentModel
{
	public static function getAllComments()
	{
		$sSql = "SELECT * FROM `comments` ORDER BY `id` DESC";
		$aRs = DB::select($sSql);
		return $aRs;
	}

	public static function findComment($nId)
	{
		$sSql = "SELECT * FROM `comments` WHERE `id` = " . $nId;
		$aRs = DB::select($sSql);
		return $aRs[0];
	}

	public static function findCommentsByMessageId($nMessageId) {
		$sSql = "SELECT * FROM `comments` WHERE `message_id` = " . $nMessageId;
		$aRs = DB::select($sSql);
		return $aRs;
	}

	public static function addComment($aData)
	{
		if (empty($aData['nickname']) || empty($aData['content'])) {
			return false;
		}
		$sSql = sprintf("
			INSERT INTO `comments` (`nickname`,`email`, `content`, `message_id`, `created_at`,`updated_at`)
			VALUES ('%s', '%s', '%s', %u, NOW(), NOW())"
			, addslashes($aData['nickname']), addslashes($aData['email']), addslashes($aData['content']), $aData['message_id']);
		$bRs = DB::insert($sSql);
		return $bRs;
	}

	public static function updComment($sNickname, $sEmail, $sContent, $nMessageId, $nId)
	{
		if (empty($sNickname) || empty($sContent)) {
			return false;
		}
		$sSql = sprintf("
			UPDATE `comments` SET `nickname` = '%s',`email` = '%s', `content` = '%s', `message_id` = %u, `updated_at` = NOW()
			WHERE `id` = %u"
			, addslashes($sNickname), addslashes($sEmail), addslashes($sContent), $nMessageId, $nId);
		$bRs = DB::update($sSql);
		return $bRs;
	}

	public static function delComment($nId)
	{
		$sSql = "DELETE FROM `comments` WHERE `id` = " . $nId;
		$bRs = DB::delete($sSql);
		return $bRs;
	}

	public static function countComment($nMessageId)
	{
		$sSql = "SELECT * FROM `comments` WHERE `message_id` = " . $nMessageId;
		$aRs = DB::select($sSql);
		$nRs = 0;
		if (isset($aRs)) {
			$nRs = count($aRs);
		}
		return $nRs;
	}
}
