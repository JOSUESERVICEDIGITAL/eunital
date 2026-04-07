<?php

namespace App\Services\Storage;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class VideoStorageService
{
    public function uploadToLocal(UploadedFile $file, $path = 'cours/contenus')
    {
        $extension = $file->getClientOriginalExtension();
        $filename = date('Y-m-d_H-i-s') . '_' . Str::random(10) . '.' . $extension;
        $fullPath = $file->storeAs($path, $filename, 'public');

        return [
            'success' => true,
            'type' => 'local',
            'path' => $fullPath,
            'url' => asset('storage/' . $fullPath),
            'filename' => $filename,
            'original_name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'extension' => $extension
        ];
    }

    public function upload(UploadedFile $file, $storageType = 'local', $path = 'cours/contenus')
    {
        return $this->uploadToLocal($file, $path);
    }

    public function delete($file)
    {
        if (isset($file['path']) && Storage::disk('public')->exists($file['path'])) {
            Storage::disk('public')->delete($file['path']);
            return true;
        }
        return false;
    }

    public function getEmbedUrl($url)
    {
        // YouTube
        if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
            $videoId = $this->getYouTubeId($url);
            return $videoId ? "https://www.youtube.com/embed/{$videoId}" : null;
        }

        // Vimeo
        if (strpos($url, 'vimeo.com') !== false) {
            $videoId = $this->getVimeoId($url);
            return $videoId ? "https://player.vimeo.com/video/{$videoId}" : null;
        }

        return $url;
    }

    protected function getYouTubeId($url)
    {
        $regExp = '/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/';
        $match = preg_match($regExp, $url, $matches);
        return ($match && strlen($matches[2]) == 11) ? $matches[2] : null;
    }

    protected function getVimeoId($url)
    {
        $regExp = '/(?:vimeo)\.com.*?(?:video\/|embed\/|channels\/.+?\/|)(\d+)/';
        $match = preg_match($regExp, $url, $matches);
        return $match ? $matches[1] : null;
    }
}
