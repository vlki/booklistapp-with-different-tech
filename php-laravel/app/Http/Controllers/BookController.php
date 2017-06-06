<?php

namespace App\Http\Controllers;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{

    /**
     * Displays list of books and actions to add and delete
     *
     * @return Response
     */
    public function index()
    {
        $books = Book::all();

        return view('book.index', ['books' => $books]);
    }

    /**
     * Deletes the book specified by the passed $id parameter
     *
     * @param $id string
     * @return Response
     */
    public function delete($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->action('BookController@index');
    }

    /**
     * Creates new book using the title passed in request form data.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            abort(400, 'Invalid request, errors: ' . $validator->errors()->__toString());
        }

        $book = new Book;
        $book->title = $request->title;
        $book->save();

        return redirect()->action('BookController@index');
    }

}
