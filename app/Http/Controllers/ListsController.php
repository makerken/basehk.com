<?php

namespace App\Http\Controllers;

use App\Lists;
use App\Prefs;
use Illuminate\Http\Request;

class ListsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Lists::all()->where('owner_id', auth()->id());
        return view('lists', compact('lists'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'words' => 'required',
        ]);

        $wordArray = preg_split('/[\s,.]+/', $attributes['words']);
        $attributes['words'] = json_encode($wordArray);
        $attributes['owner_id'] = auth()->id();
    
        lists::create($attributes);
    
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lists  $lists
     * @return \Illuminate\Http\Response
     */
    public function show($list)
    {
        $preferences = Prefs::where('user_id', auth()->id())->first();
        $preferences->active_list_num = $list;
        $preferences->save();
        if($preferences->font) {
            preg_match('/[^\']+/', $preferences->font, $matches);
            $fonturi = preg_replace('/\s/','+',$matches[0]);
            $text_color = $preferences->text_color;
            return view('play', compact('fonturi','text_color')); 
        } else {
            return view('play');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lists  $lists
     * @return \Illuminate\Http\Response
     */
    public function edit(Lists $lists, $id)
    {
        $list = Lists::where('id', $id)->where('owner_id',auth()->id())->first();
        return view('edit', compact('list')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lists  $lists
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lists $lists)
    {
        //
    }

    public function export()
    {
        $lists = Lists::where('owner_id', auth()->id())->get(['id','title','words']);
        // $lists->words = json_decode()
        return view('export', compact('lists'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lists  $lists
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lists $lists, $id)
    {
        $list = Lists::where('id', $id)->where('owner_id',auth()->id())->first();
        $list->delete();
        return back();
    }
}