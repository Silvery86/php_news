<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class FileUpload extends BaseController
{
    public function index()
    {
        $fileUploadModel = model(FileUploadModel::class);
        return view('templates/file-upload', ['fileUploads' => $fileUploadModel->orderBy('created_at', 'asc')->findAll()]);
    }
 
    public function multipleUpload() 
    {
        $filesUploaded = 0;
 
        if($this->request->getFileMultiple('fileuploads'))
        {
            $files = $this->request->getFileMultiple('fileuploads');
 
            foreach ($files as $file) {
 
                if ($file->isValid() && ! $file->hasMoved())
                {
                    $newName = $file->getRandomName();
                    $file->move(WRITEPATH.'uploads', $newName);
                    $data = [
                        'filename' => $file->getClientName(),
                        'filepath' => 'uploads/' . $newName,
                        'type' => $file->getClientExtension()
                    ];
                    $fileUploadModel = model(FileUploadModel::class);
                    $fileUploadModel->save($data);
                    $filesUploaded++;
                }
                 
            }
 
        }
 
        if($filesUploaded <= 0) {
            return redirect()->back()->with('error', 'Choose files to upload.');
        }
 
        return redirect()->back()->with('success', $filesUploaded . ' File/s uploaded successfully.');
 
    }
}

    

