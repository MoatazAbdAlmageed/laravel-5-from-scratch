<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;


class TaskController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$tasks = Task::latest()->get();
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
			'body' => 'required|unique:tasks',
		] );
		$task->body = $request['body'];
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

//		$this->validate( $request, [
//			'body' => 'required',
//			'completed' => 'required',
//		] );
//
//		Task::find($id)->update($request->all());

		$task = Task::find($id);
		$this->validate( $request, [
			'body' => 'required',
			'completed' => 'required',
		] );

		$task->body = $request['body'];
		$task->completed = $request['completed'];
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
