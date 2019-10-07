<?php

namespace App\Http\Controllers;

use App\Lists;
use App\Prefs;
use Illuminate\Http\Request;

class PrefsController extends Controller
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
        $prefs = Prefs::firstOrCreate(['user_id' => auth()->id()]);
        // $prefs = Prefs::where('user_id', auth()->id())->first();

        $fonts = ['\'Delius\', cursive;',
                '\'Comfortaa\', cursive;',
                '\'Chilanka\', cursive;',
                '\'Delius Swash Caps\', cursive;',
                '\'Imprima\', sans-serif;',
                '\'Andika\', sans-serif;',
                '\'Convergence\', sans-serif;',
                '\'Kalam\', cursive;',
                '\'ABeeZee\', sans-serif;',
                '\'Amita\', cursive;',
                '\'Inder\', sans-serif;',
                '\'Mali\', cursive;',
                '\'Merienda One\', cursive;',
                '\'Sriracha\', cursive;',
                
                '\'Be Vietnam\', sans-serif;',
                '\'Courgette\', cursive;',
                '\'Didact Gothic\', sans-serif;',
                '\'Fredoka One\', cursive;',
                '\'Lexend Deca\', sans-serif;',
                '\'Lexend Exa\', sans-serif;',
                '\'Livvic\', sans-serif;',
                '\'Manjari\', sans-serif;',
                '\'Mitr\', sans-serif;',
                '\'Muli\', sans-serif;',
                '\'Niramit\', sans-serif;',
                '\'Pacifico\', cursive;',
                '\'Poiret One\', cursive;',
                '\'Poppins\', sans-serif;',
                '\'Quicksand\', sans-serif;',
                '\'Rancho\', cursive;',
                '\'Redressed\', cursive;',
                '\'Ruluko\', sans-serif;',
                '\'Secular One\', sans-serif;',
                '\'Shadows Into Light Two\', cursive;',
                '\'Sniglet\', cursive;'];

        return view('prefs', compact('fonts','prefs')); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd( $request->except('_token') );
        $preferences = Prefs::updateOrCreate(
            ['user_id' => $request->user()->id],
             $request->except('_token')
        );

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prefs  $prefs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prefs $prefs)
    {
        $preferences = Prefs::updateOrCreate(
            ['user_id' => $request->user()->id],
             $request->except('_token')
        );

        if($preferences->active_list_num) {
            $record = Lists::where('id', $preferences->active_list_num)->where('owner_id', auth()->id())->firstOrFail();
            $preferences->words = $record->words;
        }
        
        return( $preferences );
    }

}
