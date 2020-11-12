<?php
/*We create a system Backup*/
$date      = date("Ymd");
$path      = dirname(__FILE__);
$zip_ouput = $path . '/backup/backup-' . $date . '.zip';
$rootPath  = realpath($path);
$filter    = array('backup', 'temp-update');
$zip       = new ZipArchive();
$zip->open($zip_ouput, ZipArchive::CREATE | ZipArchive::OVERWRITE);
$files = new RecursiveIteratorIterator(
    new RecursiveCallbackFilterIterator(
        new RecursiveDirectoryIterator(
            $rootPath,
            RecursiveDirectoryIterator::SKIP_DOTS
        ),
        function ($fileInfo) use ($filter) {
            return $fileInfo->isFile() || !in_array($fileInfo->getBaseName(), $filter);
        }
    )
);
foreach ($files as $name => $file) {
    if (!$file->isDir()) {
        $filePath     = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);
        $zip->addFile($filePath, $relativePath);
    }
}
$zip->close();
echo '<br><br><br>The system backup is Working, Creating Restore point; All empty folders will be ignored ...<br>';
echo 'System BackUp created in <b>' . $path . '/backup/backup-' . $date . '.zip</b><br><br>';
#Download the latest version from the Last-Hammer repository.
echo 'Downloading...<br>';
file_put_contents("TmpUpdate.zip", fopen("https://codeload.github.com/arcanisgk/Last-Hammer/zip/master", 'r'));
echo 'Download Complete!!<br><br>';
echo 'Extracting Updates...<br>';
$zip = new ZipArchive;
$res = $zip->open('TmpUpdate.zip');
if ($res === TRUE) {
    $zip->extractTo('temp-update');
    $zip->close();
    echo 'Decompression Finished!<br><br>';
} else {
    echo 'Resource for decompression error.';
    die();
}


echo 'Installing Updates...<br>';
echo $source_dir = $path . '/temp-update/Last-Hammer-master';
echo '<br>';
echo $destination_dir = $path;
echo '<br>';
recursive_files_copy($source_dir, $destination_dir);

echo 'Se ha Finalizado la Actualizacion correctamente!!!<br>';

function recursive_files_copy($source_dir, $destination_dir)
{
    // Open the source folder / directory
    $dir = opendir($source_dir);
    // Create a destination folder / directory if not exist
    if (!is_dir($destination_dir)) {
        mkdir($destination_dir);
    }
    // Loop through the files in source directory
    while ($file = readdir($dir)) {
        // Skip . and ..
        if (($file != '.') && ($file != '..')) {
            // Check if it's folder / directory or file
            if (is_dir($source_dir . '/' . $file)) {
                // Recursively calling this function for sub directory
                recursive_files_copy($source_dir . '/' . $file, $destination_dir . '/' . $file);
            } else {
                // Copying the files
                copy($source_dir . '/' . $file, $destination_dir . '/' . $file);
            }
        }
    }
    closedir($dir);
}