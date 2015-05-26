<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Model\MessageModel;
use App\Http\Model\CommentModel;
use Auth;
use Illuminate\Http\Request;
use Input;
use Redirect;


class MessagesController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('messages.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required|unique:messages|max:255',
			'body' => 'required|max:1000',
		]);

		if (MessageModel::addMessage(Input::get('title'), Input::get('body'), Auth::user()->id)) {
			return Redirect::to('admin');
		} else {
			return Redirect::back()->withInput()->withErrors('Fail to create!');
		}
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
		return view('messages.edit')->withMessage(MessageModel::findMessage($id));
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
			//title unique: exception the $id record
			'title' => 'required|unique:messages,title,' . $id . '|max:255',
			'body' => 'required|max:1000',
		]);

		$aMessage = MessageModel::findMessage($id);
		$title = Input::get('title');
		$body = Input::get('body');
		$user_id = Auth::user()->id;

		if ($aMessage->title == $title && $aMessage->body == $body) {
			return Redirect::back()->withInput()->withErrors('Data doesn\'t change!');
		}
		if (MessageModel::updMessage($title, $body, $user_id, $id)) {
			return Redirect::to('admin');
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
		MessageModel::delMessage($id);
		return Redirect::to('admin');
	}

}