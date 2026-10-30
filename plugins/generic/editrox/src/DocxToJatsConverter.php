<?php

namespace APP\plugins\generic\editrox\src;

class DocxToJatsConverter {
    public function convert($file) {
        $filePath = $file->getData('path');
        if (!file_exists($filePath)) return false;

        $outputXmlPath = preg_replace('/\.docx$/i', '.xml', $filePath);
        $command = escapeshellcmd("pandoc " . escapeshellarg($filePath) . " -f docx -t jats -o " . escapeshellarg($outputXmlPath));
        exec($command, $output, $returnCode);

        return $returnCode === 0;
    }
}
