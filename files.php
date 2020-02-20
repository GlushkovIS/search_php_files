<pre>
<?php

/**
 * Функция возвращает расширение файла
 * @param string $filename - имя файла
 * @return string расширение файла
 */

function getExtension($filename)
{
    return substr(strrchr($filename, '.'), 1);
}

/**
 * Поиск файлов php в папках и подпапках
 * @param string $folder - путь до папки
 * @return array вложенных массивов со всеми файлами
 */

function readFolder($folder)
{
    $openFolder = opendir($folder);
    while ($fileOrFolder = readdir($openFolder)) {
        if ($fileOrFolder == '.' || $fileOrFolder == '..' || !getExtension($fileOrFolder) == 'php') {
            continue;
        }
        $temp = $folder . DIRECTORY_SEPARATOR . $fileOrFolder;
        if (is_dir($temp)) {
            readFolder($temp);
        }

        $arrayFiles[] = $fileOrFolder;
    }
    return $arrayFiles;
    closedir($openFolder);
}

var_dump(readFolder($_SERVER['DOCUMENT_ROOT'] . '/templates'));
