<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function file(Request $request)
    {
        // 检查上传的文件是否存在
        if ( ! $request->hasFile('photo')) {
            dd('文件不存在');
        }

        // 获取文件对象
        $file = $request->file('photo');
        // $files = $request->photo;
        // dump($file);

        // 验证上传的文件是否有效
        if ($file->isValid()) {
            $path = $file->path();
            $extension = $file->extension();
            $gcextension = $file->getClientOriginalExtension();
            $cMimeTye = $file->getClientMimeType();
            $gmimeType = $file->getMimeType();
            dump($path, $extension, $gcextension, $cMimeTye, $gmimeType);

            // store 方法会自动生成唯一的 ID 作为文件名。文件的扩展名将通过检查文件的 MIME 类型来确定。
            $img = $file->store('public');
            // $img = $file->storeAs('images', 'leeprinceimg.'.$extension);
            dump($img);
        } else {
            dump('文件无效');
        }
    }
}
