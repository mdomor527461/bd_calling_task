<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function store(Request $request)
{
    $request->validate(['title' => 'required', 'description' => 'required']);
    $item = Item::create(['user_id' => auth()->id(), 'title' => $request->title, 'description' => $request->description]);

    return response()->json($item, 201);
}

public function index()
{
    return Item::where('user_id', auth()->id())->get();
}

public function update(Request $request, $id)
{
    $item = Item::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    $item->update($request->only(['title', 'description']));
    return response()->json($item);
}

public function destroy($id)
{
    Item::where('id', $id)->where('user_id', auth()->id())->delete();
    return response()->json(['message' => 'Item deleted']);
}

public function approve($id)
{
    $item = Item::findOrFail($id);
    $item->status = 'approved';
    $item->save();

    return response()->json($item);
}

public function reject($id)
{
    $item = Item::findOrFail($id);
    $item->status = 'rejected';
    $item->save();

    return response()->json($item);
}


}
