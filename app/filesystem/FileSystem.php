<?php

namespace App\Filesystem;

use App\Filesystem\Models\Directory;
use App\Filesystem\Models\File;
use App\Filesystem\FileSystemInterface;
use Exception;

class FileSystem implements FileSystemInterface
{
    private $root = null;

    public function addDirectory(string $dirName, $parentDirName = null)
    {
        if ($dirName === '') {
            throw new Exception("The directory name should not be empty.");
        }

        if ($parentDirName === null) {
            if ($this->root !== null) {
                throw new Exception("Root has already been defined.");
            }
            $this->root  = new Directory($dirName);
            return;
        }

        if ($this->root === null) {
            $this->root  = new Directory($parentDirName);
            $this->root->children[] = new Directory($dirName, $this->root);
            return;
        }

        if ($this->getDirectoryByName($dirName, $this->root)) {
            throw new Exception("A directory with the name `$dirName` already exists");
        }

        $parentDirectory = $this->getDirectoryByName($parentDirName, $this->root);
        if (!$parentDirectory) {
            throw new Exception("A parent directory with name `$parentDirName` does not exist");
        }
        $parentDirectory->children[] = new Directory($dirName, $parentDirectory);
    }

    private function getDirectoryByName(string $name, Directory $directory)
    {
        if ($directory->name === $name) {
            return $directory;
        }

        foreach ($directory->children as $child) {
            if (!$child instanceof Directory) {
                continue;
            }
            if ($child->name === $name) {
                return $child;
            }
            return $this->getDirectoryByName($name, $child);
        }

        return false;
    }

    private function getFileByName(string $fileName, Directory $directory)
    {
        foreach ($directory->children as $child) {
            if ($child instanceof File && $child->name === $fileName) {
                return $child;
            }
            if ($child instanceof Directory) {
                return $this->getFileByName($fileName, $child);
            }
        }

        return false;
    }

    public function addFile(string $fileName, string $parentDirName)
    {
        if ($this->getFileByName($fileName, $this->root)) {
            throw new Exception("A file with name `$fileName` already exists.");
        }

        $parentDirectory = $this->getDirectoryByName($parentDirName, $this->root);
        if (!$parentDirectory) {
            throw new Exception("A parent directory with name `$parentDirName` does not exist.");
        }

        $parentDirectory->children[] = new File($fileName, $parentDirectory);
    }

    public function getItems(string $parentDirName): array
    {
        $parentDirectory = $this->getDirectoryByName($parentDirName, $this->root);
        if (!$parentDirectory) {
            throw new Exception("A parent directory with name `$parentDirName` does not exist.");
        }
        return array_column($parentDirectory->children, 'name');
    }

    public function deleteSubdirectory(string $dirName)
    {
        if ($dirName === '') {
            throw new Exception("The directory name should not be empty.");
        }

        $directory = $this->getDirectoryByName($dirName, $this->root);
        if (!$directory) {
            throw new Exception("A parent directory with name `$dirName` does not exist.");
        }
        foreach ($directory->parent->children as $k => $child) {
            if ($child === $directory) {
                unset($directory->parent->children[$k]);
                break;
            }
        }
    }

    public function deleteFile(string $dirName, string $fileName)
    {
        if ($fileName === '') {
            throw new Exception("The file name should not be empty.");
        }
        if ($dirName === '') {
            throw new Exception("The directory name should not be empty.");
        }
        $directory = $this->getDirectoryByName($dirName, $this->root);
        if (!$directory) {
            throw new Exception("A directory with name `$dirName` does not exist.");
        }
        $file = $this->getFileByName($fileName, $directory);
        if (!$file) {
            throw new Exception("A file with name `$fileName` does not exist.");
        }

        foreach ($directory->children as $i => $child) {
            if ($child === $file) {
                unset($directory->children[$i]);
                break;
            }
        }
    }
}
