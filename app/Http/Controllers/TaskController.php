<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$user = User::find(Auth::id());
		$tasks = $user->tasks()->get();
		return view( 'tasks.index', compact( 'tasks') );

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$this->middleware( 'auth' );

		return view( 'tasks.create' );

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {

		$task = new Task();
		$this->validate( $request, [
			'title' => 'required',
			'body' => 'required|unique:tasks',

		] );
		$task->title = $request['title'];
		$task->body = $request['body'];

		$task->user_id = Auth::id();


		if ($request['send_mail'] == 'on'){
			$task->send_mail  = 1 ;
		}
		else{
			$task->send_mail  = 0 ;
		}

		$task->save();

		return redirect( '/tasks' )->with( 'success', $task->body . '  has been created!' );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( Task $task ) {
		return view( 'tasks.show', compact( 'task' ) );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Task $task ) {
		return view( 'tasks.edit', compact( 'task' ) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {


		$task = Task::find($id);
		$this->validate( $request, [
			'title' => 'required',
			'body' => 'required',
			'is_completed' => 'required',
		] );



		if ($request['send_mail'] == 'on'){
			$task->send_mail  = 1 ;
		}
		else{
			$task->send_mail  = 0 ;
		}



		$task->title = $request['title'];
		$task->body = $request['body'];

		$task->is_completed = $request['is_completed'];
		$task->update();


		return redirect()->route('tasks.index')
		                 ->with('success','Task updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		Task::find($id)->delete();
		return redirect()->route('tasks.index')
		                 ->with('success','Task deleted successfully');
	}



}
