<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Project;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final class FileUpload
{
     public function upload(UploadedFile $file, Project $project): string
     {
         if ($project->image) {
              if (Storage::disk('public')->exists($project->image)) {
                  Storage::disk('public')->delete($project->image);
              }
         }

         $fileName = "id-" . $project->id . "-" . $file->getClientOriginalName();
         $link = $file->storeAs('projects', $fileName, 'public');
         if (! $link) {
             throw new \Exception('Could not store project image');
         }

         return $link;
     }
}
