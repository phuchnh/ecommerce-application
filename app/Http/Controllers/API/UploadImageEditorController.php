<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class UploadImageEditorController extends Controller
{
    public function __invoke(Request $request)
    {

        $path = optional($request->file('image'))->storePublicly('uploads/images', [
            'disk' => 'public'
        ]);
        
        return Response::json([
            'url' => Storage::disk('public')->url($path)
        ]);
    }
}
