<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlatformContent;
use Illuminate\Http\Request;

class PlatformContentController extends Controller
{
    //

    public function index() {
        $pcontents = PlatformContent::select('id', 'page', 'container')->get();
        return view('admin.platform_content.platform_content')->with(compact('pcontents'));
    }

    public function show(PlatformContent $pcontent) {
        return response()->json(['content' => $pcontent->content]);
    }

    public function edit(Request $request, PlatformContent $pcontent) {
        $this->validate($request, [
            'content' => 'required|string'
        ]);

        // Get the content from the request
        $content = $request->input('content');

        // Update or save the content in the database
        $pcontent->content = $content;
        $pcontent->save();

        // Return a response if needed
        return response()->json(['message' => 'Content saved successfully']);
    }
}
