<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\EventRequest as Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Exception;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $events = Event::all();
        return response()->view('events.index', compact('events'));
    }

    /**
     * @return Response
     */
    public function create()
    {
        return response()->view('events.create');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $event = Event::create($request->validated());

        if ($request->ajax()) {
            response($event);
        }

        return response()->redirectToRoute('events.show', $event->id);
    }

    /**
     * @param Event $event
     *
     * @return ResponseFactory|Response
     */
    public function show(Event $event)
    {
        if (request()->ajax()) {
            return response($event);
        }

        return response()->view('events.show', compact('event'));
    }

    /**
     * @param Event $event
     *
     * @return Response
     */
    public function edit(Event $event)
    {
        return response()->view('events.edit', compact('event'));
    }

    /**
     * @param Request $request
     * @param Event   $event
     *
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function update(Request $request, Event $event)
    {
        $event->update($request->validated());

        if ($request->ajax()) {
            return response($event);
        }

        return response()->redirectToRoute('events.show', $event->id);
    }

    /**
     * @param Event $event
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return response()->redirectToRoute('events.index');
    }
}
