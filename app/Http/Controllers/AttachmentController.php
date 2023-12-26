<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    public function destroy(Attachment $attachment)
    {
        $attachment->delete();
        return redirect()->back()->with('success', 'Photo is deleted successfully.');
    }
}
