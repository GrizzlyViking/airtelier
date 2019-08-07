<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\MessageRequest as Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Exception;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $messages = Message::all();
        return response()->view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return response()->view('messages.create');
    }

    /**
     * @param Request $request
     *
     * @return ResponseFactory
     */
    public function store(Request $request)
    {
        $message = Message::create($request->all());

        if($request->ajax()) {
            return response($message);
        }
        return response()->redirectToRoute('messages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Message  $message
     * @return Response
     */
    public function show(Message $message)
    {
        return response()->view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Message  $message
     * @return Response
     */
    public function edit(Message $message)
    {
        return response()->view('messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Message  $message
     * @return Response
     */
    public function update(Request $request, Message $message)
    {
        $message->update($request->validated());

        if ($request->ajax()) {
            return response($message);
        }

        return response()->redirectToRoute('messages.show', $message->id);
    }

    /**
     * @param Message $message
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return response()->redirectToRoute('messages.index');
    }
}
