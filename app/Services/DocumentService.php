<?php

namespace App\Services;

use App\Models\Documents;
use Illuminate\Support\Str;

class DocumentService
{

    public function createDocument(array $data)
    {
        $doc = Documents::create([
            'major' => $data['major'],
            'education_level' => $data['education_level'],
            'job_status' => $data['job_status'],
            'job' => $data['job'],
            'job_type' => $data['job_type'],
            'birth_date' => $data['birth_date'],
            'address' => $data['address'],
            'marriage_status' => $data['marriage_status'],
            'children_count' => $data['children_count']
        ]);
        return $doc;
    }

    public function upload($doc, $file, $path)
    {
        $fileName = Str::random() . '-' . $file->getClientOriginalName();
        $file->move(public_path() . $path, $fileName);
        $destination = explode('/',$path);
        if ($destination[1] == 'active_basij')
        {
            $doc->update([
                'active_basij' => $fileName
            ]);
        }
        $doc->update([
            'war_history' => $fileName
        ]);
        return 1;
    }
}
