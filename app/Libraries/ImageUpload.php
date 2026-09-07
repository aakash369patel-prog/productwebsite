<?php

namespace App\Libraries;

class ImageUpload
{
    protected array $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
    protected int $maxSize = 5242880; // 5MB
    protected int $maxWidth = 1920;
    protected int $maxHeight = 1920;

    public function upload($file, string $folder): array
    {
        if (! $file || ! $file->isValid()) {
            return ['success' => false, 'message' => 'Invalid file upload.'];
        }

        if ($file->getSize() > $this->maxSize) {
            return ['success' => false, 'message' => 'File size exceeds 5MB limit.'];
        }

        $extension = strtolower($file->getExtension());

        if (! in_array($extension, $this->allowedExtensions, true)) {
            return ['success' => false, 'message' => 'Only JPG, JPEG, PNG and WEBP files are allowed.'];
        }

        $mime = $file->getMimeType();
        $allowedMimes = ['image/jpeg', 'image/png', 'image/webp'];

        if (! in_array($mime, $allowedMimes, true)) {
            return ['success' => false, 'message' => 'Invalid image MIME type.'];
        }

        $uploadPath = FCPATH . 'uploads/' . trim($folder, '/') . '/';

        if (! is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $filename = $this->generateFilename($extension);
        $file->move($uploadPath, $filename, true);

        $fullPath = $uploadPath . $filename;
        $this->resizeImage($fullPath, $extension);
        $this->generateWebP($fullPath, $extension);

        return [
            'success'  => true,
            'filename' => trim($folder, '/') . '/' . $filename,
            'message'  => 'File uploaded successfully.',
        ];
    }

    public function delete(?string $path): void
    {
        if (empty($path)) {
            return;
        }

        $fullPath = FCPATH . 'uploads/' . ltrim($path, '/');

        if (is_file($fullPath)) {
            unlink($fullPath);
        }

        $webpPath = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $fullPath);

        if ($webpPath && is_file($webpPath)) {
            unlink($webpPath);
        }
    }

    protected function generateFilename(string $extension): string
    {
        return date('Ymd') . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
    }

    protected function resizeImage(string $path, string $extension): void
    {
        if (! extension_loaded('gd') && ! extension_loaded('imagick')) {
            return;
        }

        try {
            $image = \Config\Services::image();
            $image->withFile($path);

            if ($image->getWidth() > $this->maxWidth || $image->getHeight() > $this->maxHeight) {
                $image->resize($this->maxWidth, $this->maxHeight, true)->save($path);
            }
        } catch (\Throwable $e) {
            log_message('error', 'Image resize failed: ' . $e->getMessage());
        }
    }

    protected function generateWebP(string $path, string $extension): void
    {
        if ($extension === 'webp' || ! function_exists('imagewebp')) {
            return;
        }

        try {
            $webpPath = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $path);
            $image    = null;

            switch ($extension) {
                case 'jpg':
                case 'jpeg':
                    $image = imagecreatefromjpeg($path);
                    break;
                case 'png':
                    $image = imagecreatefrompng($path);
                    break;
            }

            if ($image) {
                imagewebp($image, $webpPath, 80);
                imagedestroy($image);
            }
        } catch (\Throwable $e) {
            log_message('error', 'WebP generation failed: ' . $e->getMessage());
        }
    }
}
