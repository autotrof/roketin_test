<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    public function store()
    {
        $validation = Validator::make(request()->all(),[
            'title'=>'required',
            'description'=>'required',
            'duration'=>'required'
        ]);
        if(count($validation->errors())>0){
            return response()->json(['success'=>false,'errors'=>$validation->errors()],422);
        }
        $movie = Movie::create(request()->only(['title','description','duration','artists','genres']));
        return response()->json(['success'=>true,'data'=>$movie]);
    }

    public function update()
    {
        $validation = Validator::make(request()->all(),[
            'id'=>'required|numeric|exists:movies,id',
            'title'=>'required',
            'description'=>'required',
            'duration'=>'required'
        ]);
        if(count($validation->errors())>0){
            return response()->json(['success'=>false,'errors'=>$validation->errors()],422);
        }
        $movie = Movie::find(request('id'));

        $movie->fill(request()->only(['title','description','duration','artists','genres']));
        $movie->save();
        return response()->json(['success'=>true,'data'=>$movie]);
    }

    public function list($page=1)
    {
        if($page<1 || !is_int($page)) $page=1;
        
        $take = 30;
        $skip = ($page - 1) * $take;
        $movies = Movie::select('*');
        if(request('query')){
            $movies->whereRaw('LOWER(title) like ?','%'.strtolower(request('query')).'%')
            ->orWhereRaw('LOWER(description) like ?','%'.strtolower(request('query')).'%')
            ->orWhereRaw('LOWER(artists) like ?','%'.strtolower(request('query')).'%')
            ->orWhereRaw('LOWER(genres) like ?','%'.strtolower(request('query')).'%')
            ;
        }
        $movie = $movies->skip($skip)->take($take)->orderBy('created_at','desc')->get();
        return response()->json(['success'=>true,'data'=>$movie]);
    }
}
