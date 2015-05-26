<?php namespace App\Http\Controllers\Admin;

use App\Http\Model\CommentModel;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use Redirect;

class CommentsController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('comments.home')->withComments(CommentModel::getAllComments());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function edit($id)
	{

		return view('comments.edit')->withComment(CommentModel::findComment($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'nickname' => 'required|max:255',
			'content' => 'required|max:10000',
		]);

		$aComment = CommentModel::findComment($id);
		$nickname = Input::get('nickname');
		$email = Input::get('email');
		$content = Input::get('content');

		if ($aComment->nickname == $nickname && $aComment->email == $email && $aComment->content == $content) {
			return Redirect::back()->withInput()->withErrors('Data doesn\'t change!');
		}
		if (CommentModel::updComment($nickname, $email, $content, Input::get('message_id'), $id)) {
			return Redirect::to('admin/comments');
		} else {
			return Redirect::back()->withInput()->withErrors('Fail to update!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function destroy($id)
	{
		CommentModel::delComment($id);
		return Redirect::to('admin/comments');
	}

}
