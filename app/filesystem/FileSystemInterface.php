<?php

namespace App\Filesystem;

interface FileSystemInterface
{
    /**
     * Adds directories to the filesystem
     *
     * @param string $dirName
     * @param string|null $parentDirName
     * @return void
     */
    public function addDirectory(string $dirName, $parentDirName = null);

    /**
     * Adds files to the filesystem
     *
     * @param string $fileName
     * @param string $parentDirName
     * @return void
     */
    public function addFile(string $fileName, string $parentDirName);

    /**
     * Retrieves a directory's direct items from the filesystem
     *
     * @param string $parentDirName
     * @return array
     */
    public function getItems(string $parentDirName): array;

    /**
     * Deletes a directory from the filesystem
     *
     * @param string $dirName
     * @return void
     */
    public function deleteSubdirectory(string $dirName);

    /**
     * Deletes a file from the filesystem
     *
     * @param string $dirName
     * @param string $fileName
     * @return void
     */
    public function deleteFile(string $dirName, string $fileName);
}
