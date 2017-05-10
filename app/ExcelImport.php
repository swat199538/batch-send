<?php
namespace App;

use Maatwebsite\Excel\Files\ExcelFile;

class ExcelImport extends ExcelFile
{
    public function getFile()
    {
        return realpath(base_path('public')).'/file/sms-template.xls';
    }

    public function getFilters()
    {
        return [
            'chunk'
        ];
    }

}