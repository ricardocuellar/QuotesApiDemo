<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quotes = Quote::all();
        
        return $quotes;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request['slug'] = Str::slug($request['title'],'-');

        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:quotes',
            'body' => 'required'
        ]);
        
        $quote = Quote::create([
            'title' => request('title'),
            'slug'  => request('slug'),
            'body' => request('body'),
            'user_id' => Auth::id()
        ]);
        
        return $quote;    


    }

    /**
     * Display the specified resource.
     */
    public function show(Quote $quote)
    {
        return $quote;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quote $quote)
    {
        if(Auth::check()){
            $request->validate([
                'title' => 'required|max:255',
                'slug' => 'required|max:255|unique:quotes,slug,'.$quote->id,
                'body' => 'required'
            ]);

            $quote->update($request->all());
            
            return $quote;

        }else{
            return response('You need login to edit something', 403);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quote $quote)
    {
        $quote->delete();

        return $quote;
    }
}
