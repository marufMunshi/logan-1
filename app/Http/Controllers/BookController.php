<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Language;
use Auth;
use Carbon\Carbon;

use \App\Book;
use \App\Author;


class BookController extends Controller
{

    public function index ()
    {
        // $user_id = Auth::user()->id;
        // $books = Book::with('users')->get();
        // dd($books);
        $books = Book::with('users')
                    ->whereHas('users', function($q) {
                                   $q->where('user_id', Auth::id());
                        })
                   ->get();
        // return $books[0]->purchaseDates[0]->purchase_date;
        // return $books[1]->users[0]->pivot->status;
        return view('admin.admin-books-list', compact('books'));
    }

    public function create()
    {
        // return categories from categories table
        $categories = Category::all();
        // return languages from languages table
        $languages = Language::all();
        return view('admin.admin-add-book', compact('categories', 'languages'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'name' => 'required|string',
            'category_id' => 'required|numeric',
            'language_id' => 'required|numeric',
            'pub_year' => 'required|numeric',
        ]);

        // this function add new author in author table
        // if author existed returned id
        $author = Author::firstOrNew([
            'name' => $request->input('name')
        ]);

        if ($author->id == null)
        {
            $author->save();
        }

        $book = Book::insertGetId([
            'category_id' => $request->input('category_id'),
            'edition' => $request->input('edition'),
            'language_id' =>$request->input('language_id'),
            'pub_year' => $request->input('pub_year'),
            'title' => $request->input('title')
        ]);

        $user_id = Auth::user(); // current user id

        $author->books()->attach($book); // inserting data in the pivot table
        // $book->users()->attach($user_id);
        $user_id->books()->attach($book);

        // for success notification
        $request->session()->flash('status', 'Book added successfully!');

        return redirect('/dashboard');

    }
}
