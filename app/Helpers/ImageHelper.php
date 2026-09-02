<?php

namespace App\Helpers;

/**
 * ImageHelper — Professional server-side image optimization using PHP GD.
 * 
 * Handles image resizing, compression, and format conversion automatically.
 * No external packages required — uses PHP's built-in GD extension.
 * 
 * This eliminates the need for .user.ini or .htaccess php_value overrides.
 * All images are processed at the application level before storage.
 */
class ImageHelper
{
    /**
     * Maximum dimension (width or height) for stored images.
     */
    private const MAX_DIMENSION = 1200;

    /**
     * JPEG compression quality (1-100). 80 gives excellent quality at ~70% size reduction.
     */
    private const JPEG_QUALITY = 80;

    /**
     * PNG compression level (0-9). 6 is a good balance of speed vs compression.
     */
    private const PNG_COMPRESSION = 6;

    /**
     * WebP compression quality (1-100).
     */
    private const WEBP_QUALITY = 80;

    /**
     * Process and store an uploaded image file.
     * 
     * - Resizes to max 1200px on the longest side
     * - Compresses to ~200-500KB regardless of original size
     * - Saves to both storage/app/public and public/uploads for symlink-free hosting
     * - Returns the relative storage path (e.g., "devotees/abc123.jpg")
     *
     * @param \Illuminate\Http\UploadedFile $file  The uploaded file from the request
     * @param string $directory  The subdirectory to store in (e.g., 'devotees', 'gallery')
     * @return string|null  The relative path to the stored image, or null on failure
     */
    public static function processAndStore($file, string $directory): ?string
    {
        try {
            // Read image info
            $tmpPath = $file->getRealPath();
            $imageInfo = @getimagesize($tmpPath);

            if (!$imageInfo) {
                // Not a valid image or GD can't read it — store as-is
                return self::storeRaw($file, $directory);
            }

            $mime = $imageInfo['mime'];
            $srcImage = self::createImageFromFile($tmpPath, $mime);

            if (!$srcImage) {
                return self::storeRaw($file, $directory);
            }

            // Get original dimensions
            $origWidth = imagesx($srcImage);
            $origHeight = imagesy($srcImage);

            // Calculate new dimensions (maintain aspect ratio)
            [$newWidth, $newHeight] = self::calculateDimensions($origWidth, $origHeight);

            // Create optimized image
            $dstImage = imagecreatetruecolor($newWidth, $newHeight);

            // Preserve transparency for PNG/WebP
            if (in_array($mime, ['image/png', 'image/webp'])) {
                imagealphablending($dstImage, false);
                imagesavealpha($dstImage, true);
                $transparent = imagecolorallocatealpha($dstImage, 0, 0, 0, 127);
                imagefill($dstImage, 0, 0, $transparent);
            }

            // High-quality resize
            imagecopyresampled(
                $dstImage, $srcImage,
                0, 0, 0, 0,
                $newWidth, $newHeight,
                $origWidth, $origHeight
            );

            // Generate unique filename
            $extension = self::getOutputExtension($mime);
            $filename = $directory . '/' . uniqid('img_', true) . '.' . $extension;

            // Ensure directories exist
            $storagePath = storage_path('app/public/' . $filename);
            $publicPath = public_path('uploads/' . $filename);

            self::ensureDirectoryExists(dirname($storagePath));
            self::ensureDirectoryExists(dirname($publicPath));

            // Save optimized image to storage
            self::saveImage($dstImage, $storagePath, $mime);

            // Also save to public/uploads for symlink-free hosting (like Hostinger)
            @copy($storagePath, $publicPath);

            // Free memory
            imagedestroy($srcImage);
            imagedestroy($dstImage);

            return $filename;

        } catch (\Throwable $e) {
            // If GD processing fails, fall back to raw storage
            return self::storeRaw($file, $directory);
        }
    }

    /**
     * Process and store an image uploaded as a Base64 string (from client-side canvas).
     *
     * @param string $base64Data  The base64 data URL or raw base64 string
     * @param string $directory   The target directory (e.g. 'devotees', 'gallery')
     * @return string|null        The relative path, or null on failure
     */
    public static function processAndStoreBase64(string $base64Data, string $directory): ?string
    {
        try {
            if (empty(trim($base64Data))) {
                return null;
            }

            // Strip data URL prefix (e.g. "data:image/jpeg;base64,")
            if (str_contains($base64Data, ',')) {
                $base64Data = substr($base64Data, strpos($base64Data, ',') + 1);
            }

            $binaryData = base64_decode($base64Data, true);
            if ($binaryData === false || strlen($binaryData) === 0) {
                return null;
            }

            // Create GD image from binary string
            $srcImage = @imagecreatefromstring($binaryData);
            if (!$srcImage) {
                return null;
            }

            $origWidth = imagesx($srcImage);
            $origHeight = imagesy($srcImage);

            [$newWidth, $newHeight] = self::calculateDimensions($origWidth, $origHeight);

            $dstImage = imagecreatetruecolor($newWidth, $newHeight);

            imagecopyresampled(
                $dstImage, $srcImage,
                0, 0, 0, 0,
                $newWidth, $newHeight,
                $origWidth, $origHeight
            );

            $filename = $directory . '/' . uniqid('img_', true) . '.jpg';

            $storagePath = storage_path('app/public/' . $filename);
            $publicPath = public_path('uploads/' . $filename);

            self::ensureDirectoryExists(dirname($storagePath));
            self::ensureDirectoryExists(dirname($publicPath));

            imagejpeg($dstImage, $storagePath, self::JPEG_QUALITY);
            @copy($storagePath, $publicPath);

            imagedestroy($srcImage);
            imagedestroy($dstImage);

            return $filename;
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Delete an image from both storage locations.
     *
     * @param string|null $path  The relative path (e.g., "devotees/img_abc.jpg")
     */
    public static function delete(?string $path): void
    {
        if (!$path) {
            return;
        }

        $storagePath = storage_path('app/public/' . $path);
        $publicPath = public_path('uploads/' . $path);

        if (file_exists($storagePath)) {
            @unlink($storagePath);
        }
        if (file_exists($publicPath)) {
            @unlink($publicPath);
        }
    }

    /**
     * Create a GD image resource from a file path.
     */
    private static function createImageFromFile(string $path, string $mime)
    {
        return match ($mime) {
            'image/jpeg', 'image/jpg' => @imagecreatefromjpeg($path),
            'image/png'               => @imagecreatefrompng($path),
            'image/gif'               => @imagecreatefromgif($path),
            'image/webp'              => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($path) : null,
            'image/bmp'               => function_exists('imagecreatefrombmp') ? @imagecreatefrombmp($path) : null,
            'image/avif'              => function_exists('imagecreatefromavif') ? @imagecreatefromavif($path) : null,
            default                   => null,
        };
    }

    /**
     * Calculate new dimensions while maintaining aspect ratio.
     *
     * @return array [width, height]
     */
    private static function calculateDimensions(int $origWidth, int $origHeight): array
    {
        if ($origWidth <= self::MAX_DIMENSION && $origHeight <= self::MAX_DIMENSION) {
            return [$origWidth, $origHeight];
        }

        if ($origWidth > $origHeight) {
            $newWidth = self::MAX_DIMENSION;
            $newHeight = (int) round(($origHeight * self::MAX_DIMENSION) / $origWidth);
        } else {
            $newHeight = self::MAX_DIMENSION;
            $newWidth = (int) round(($origWidth * self::MAX_DIMENSION) / $origHeight);
        }

        return [$newWidth, $newHeight];
    }

    /**
     * Save a GD image to a file path with proper compression.
     */
    private static function saveImage($image, string $path, string $originalMime): void
    {
        match ($originalMime) {
            'image/png'  => imagepng($image, $path, self::PNG_COMPRESSION),
            'image/gif'  => imagegif($image, $path),
            'image/webp' => function_exists('imagewebp') ? imagewebp($image, $path, self::WEBP_QUALITY) : imagejpeg($image, $path, self::JPEG_QUALITY),
            default      => imagejpeg($image, $path, self::JPEG_QUALITY),
        };
    }

    /**
     * Get the output file extension based on MIME type.
     */
    private static function getOutputExtension(string $mime): string
    {
        return match ($mime) {
            'image/png'  => 'png',
            'image/gif'  => 'gif',
            'image/webp' => 'webp',
            default      => 'jpg',
        };
    }

    /**
     * Fallback: store file as-is when GD processing fails.
     */
    private static function storeRaw($file, string $directory): ?string
    {
        $path = $file->store($directory, 'public');

        if ($path) {
            try {
                $publicDir = public_path('uploads/' . dirname($path));
                self::ensureDirectoryExists($publicDir);
                @copy(storage_path('app/public/' . $path), public_path('uploads/' . $path));
            } catch (\Throwable $e) {
                // Ignore
            }
        }

        return $path;
    }

    /**
     * Ensure a directory exists, creating it recursively if needed.
     */
    private static function ensureDirectoryExists(string $dir): void
    {
        if (!file_exists($dir)) {
            @mkdir($dir, 0755, true);
        }
    }
}
