<?php

class FileService {

    const UPLOAD_DIRECTORY = __DIR__ . '/../../public/uploads/';

    public static function moveUploadedFile($file): ?string {
        $pathinfo = pathinfo($file["name"]);
        $filename = self::generateUniqueFilename($pathinfo);
        $destination = self::UPLOAD_DIRECTORY . $filename;
        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            return null;
        }
        return $filename;
    }

    private static function generateUniqueFilename($pathinfo) {
        $base = $pathinfo["filename"];
        $base = preg_replace("/[^\w-]/", "_", $base);
        $extension = $pathinfo["extension"];
        $i = 0;

        $filename = $base . '.' . $extension;
        $destination = self::UPLOAD_DIRECTORY . $filename;

        while (file_exists($destination)) {
            $i++;
            $filename = sprintf('%s(%d).%s', $base, $i, $extension);
            $destination = self::UPLOAD_DIRECTORY . $filename;
        }

        return $filename;
    }
}
