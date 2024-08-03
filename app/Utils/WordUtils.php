<?php

namespace App\Utils;

use PhpOffice\PhpWord\TemplateProcessor;

class WordUtils
{
    public static function process($template, $output, $data)
    {
        $templateProcessor = new TemplateProcessor($template);

        foreach ($data as $placeholder => $value) {
            if (is_array($value) && isset($value['type']) && $value['type'] === 'image') {
                if (file_exists($value['path'])) {
                    $templateProcessor->setImageValue($placeholder, [
                        "path" => $value['path'],
                        "width" => 320,
                        "height" => 180,
                        'ratio' => false,
                    ]);
                } else {
                    $templateProcessor->setValue($placeholder, '');
                }
            } else {
                $templateProcessor->setValue($placeholder, $value);
            }
        }


        header('Content-Type: application/octet-stream');
        header(sprintf('Content-Disposition: attachment; filename="%s"', $output));
        $templateProcessor->saveAs('php://output');
    }
}
