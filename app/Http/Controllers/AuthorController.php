<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorController extends Controller
{

    Use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return Authors Lists.
     *
     * @return Illuminate\Http\Response;
     */
    public function index(){
        $authors = Author::all();
        return $this->successResponse($authors);
    }

    /**
     * Create an instance of author.
     *
     * @return Illuminate\Http\Response;
     */
    public function store(Request $request){
        $rules =[
            'name' => 'required|max:255',
            'gender' => 'required|max:255|in:male,female',
            'country' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $authors = Author::create($request->all());

        return $this->successResponse($authors, Response::HTTP_CREATED);
    }

    /**
     * Return an specific author.
     *
     * @return Illuminate\Http\Response;
     */
    public function show($id){

        $authors = Author::findOrFail($id);

        return $this->successResponse($authors);

    }


    /**
     * Update the information of an existing author
     *
     * @return Illuminate\Http\Response;
     */
    public function update(Request $request, $id){
        $rules =[
            'name' => 'max:255',
            'gender' => 'max:255|in:male,female',
            'country' => 'max:255',
        ];
        $this->validate($request, $rules);

        $author = Author::findOrFail($id);

        $author->fill($request->all());

        if ($author->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $author->save();

        return  $this->successResponse($author);
    }

    /**
     * Remove an existing author
     *
     * @return Illuminate\Http\Response;
     */
    public function destroy($id){
        $author = Author::findOrFail($id);

        $author->delete();

        return $this->successResponse($author);
    }
    //
}
