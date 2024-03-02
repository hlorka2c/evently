<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Event::orderBy('created_at', 'DESC')->get();
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
        $newEvent = new Event;
        $newEvent->name = $request['event.name'];
        $newEvent->save();

        return $newEvent;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existingEvent = Event::find( $id );
        if( $existingEvent ) {
            $existingEvent->completed = $request['event.completed'] ? true : false;
            $existingEvent->completed_at = $request['event.completed'] ? Carbon::now() : null;
            $existingEvent->save();
            return $existingEvent;
        }
        
        return 'Event not found';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingEvent = Event::find( $id );

        if( $existingEvent ) {
            $existingEvent->delete();
            return 'Item successfully deleted.';
        }

        return 'Item not found.';
    }
}