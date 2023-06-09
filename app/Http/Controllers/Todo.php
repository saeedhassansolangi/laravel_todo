<?php
namespace APP\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Request;

class Todo extends BaseController
{


  public function showHomePage()
  {
    return view('todo_show');
  }

  public function getAllTodos()
  {
    return Response::json(array('todos' => DB::select('select * from todo')));
  }

  public function createTodo(Request $req)
  {

    $req->validate([
      'title' => ['required', 'min:5', 'max:30'],
      'description' => [
        'required',
        'min:5',
      ],
    ]);

    $title = $req->title;
    $desc = $req->description;
    $query = 'insert into todo (task_title, task_description) values (?, ?)';

    try {
      DB::insert($query, [$title, $desc]);

      return Response::json(
        array('message' => 'success'), status: 201
      );
    } catch (\Throwable $th) {
      return Response::json(
        array(
          'message' => $th->getMessage()
        ),
        status: $th->getCode()
      );
    }
  }

  public function getSingleTodo($id)
  {
    return Response::json(['todo' => DB::table('todo')->where('id', $id)->first()], status: 200);
  }

  public function todoUpdate(Request $req)
  {
    $req->validate([
      "todo_id" => ['required'],
      'title' => ['required', 'string', 'min:5', 'max:30'],
      'description' => ['required', 'min:5', 'string'],
      'status' => ['required']
    ]);

    dd($req);


    $id = $req->todo_id;
    $title = $req->title;
    $desc = $req->description;
    $status = $req->status;

    $query = 'update todo set task_title=?, task_description=?, is_task_complete=? where id = ?';

    try {
      // dd($status);
      DB::update($query, [$title, $desc, $status, $id]);

      return redirect('/');
    } catch (\Throwable $th) {
      return $th->getMessage();
    }
  }

  public function editTodo(Request $req)
  {
    $req->validate([
      "todo_id" => ['required'],
      'title' => ['required', 'string', 'min:5', 'max:30'],
      'description' => ['required', 'min:5', 'string'],
      'status' => ['required']
    ]);

    $id = $req->todo_id;
    $title = $req->title;
    $desc = $req->description;
    $status = $req->status;

    $query = 'update todo set task_title=?, task_description=?, is_task_complete=? where id = ?';

    try {
      // dd($status);
      DB::update($query, [$title, $desc, $status, $id]);

      // return redirect('/');
      return Response::json(array('message' => 'Todo Updated Successfully'), status: 200);
    } catch (\Throwable $th) {
      return $th->getMessage();
    }
  }

  public function todoDelete($id)
  {

    try {
      $deleted = DB::delete('delete from todo where id = ?', [$id]);

      if ($deleted)
        return redirect('/');

      return 'Something went wrong While deleting record';
    } catch (\Throwable $th) {
      return Response::json(
        array(
          'message' => $th->getMessage(),
          'statusCode' => $th->getCode()
        ),
        status: $th->getCode()
      );
    }
  }

  public function deleteTodo($id)
  {

    try {
      $deleted = DB::delete('delete from todo where id = ?', [$id]);

      if (!$deleted) {
        return Response::json(array('message' => "Todo not found"), status: 404);
      }

      return Response::json(
        array(
          'message' => "Todo Deleted Successfully",
        ),
      );


    } catch (\Throwable $th) {
      return Response::json(
        array(
          'message' => $th->getMessage(),
          'statusCode' => $th->getCode()
        ), status: $th->getCode()
      );
    }
  }


  public function todoShowUpdateForm($id)
  {
    return view('todo_update', ['todo' => DB::table('todo')->where('id', $id)->first()]);
  }

  // public function showForm()
  // {
  //   return view('todo_create');
  // }


  // public function showTodos()
  // {
  //   return view('todo_show', ['todos' => DB::select('select * from todo')]);
  // }

  // public function addTodo(Request $req)
  // {


  //   $req->validate([
  //     'title' => ['required', 'max:30'],
  //     'description' => ['required'],
  //   ]);

  //   $title = $req->title;
  //   $desc = $req->description;
  //   $query = 'insert into todo (task_title, task_description) values (?, ?)';

  //   try {
  //     DB::insert($query, [$title, $desc]);
  //     return redirect('/');
  //   } catch (\Throwable $th) {
  //     return $th->getMessage();
  //   }
  // }

  // 

  // public function show()
  // {
  //   return 'hello testing';
  // }

  // echo $req->getContent();
  // printr($req->all());
}