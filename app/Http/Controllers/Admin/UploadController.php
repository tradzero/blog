<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Qiniu\Storage\UploadManager;

class UploadController extends Controller
{
    public function qiniuUpload(Request $request)
    {
        $auth = app('qiniuAuth');
        $token = $auth->uploadToken(config('services.qiniu.bucket'));
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, null, $request->file('file'));

        $url = config('services.qiniu.url') . $ret['key']; 

        if($err !== null){
            return response()->json(['status' => 1, 'message' => $err], 400);
        }else{
            return response()->json(['status' => 0, 'message' => 'success', 'url' => $url], 200);
        }
    }
}
