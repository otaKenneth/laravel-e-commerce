<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlatformContent;
use App\Models\TrustedBy;
use Illuminate\Http\Request;
use App\Services\FileStorageService;

class PlatformContentController extends Controller
{
    //

    public function index() {
        $pcontents = PlatformContent::select('id', 'page', 'container')->get();
        $trusted_by_list = TrustedBy::all();
        return view('admin.platform_content.platform_content')->with(compact('pcontents', 'trusted_by_list'));
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

    public function saveTrustedBy(Request $request) {
        $request->validate([
            'files.*' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('files')) {
            $fileStorageService = new FileStorageService;

            foreach ($request->file('files') as $image) {
                // dd($image);
                
                // Get image name
                $image_name = $image->getClientOriginalName();
                // dd($image_tmp);
                
                // Get image extension
                $extension = $image->getClientOriginalExtension();
                
                // Generate a new random name for the uploaded image (to avoid that the image might get overwritten if its name is repeated)
                $imageName = rand(111, 99999) . '.' . $extension; // e.g. 5954.png
                $path = 'front/images/trusted_by/' . $imageName;
                
                $fileStorageService->storeFile($image, $path);
                
                $trustedBy = new TrustedBy;
                $trustedBy->image = $imageName;
                $trustedBy->save();
            }

            $trusted_by_list = TrustedBy::all();
            return response()->json([
                'success' => true, 'message' => 'Files uploaded successfully', 
                'view' => (String) \Illuminate\Support\Facades\View::make('admin.platform_content.trusted_by_list')->with(compact('trusted_by_list')),
            ]);
        }

        return response()->json(['error' => 'No files found'], 400);
    }
}
