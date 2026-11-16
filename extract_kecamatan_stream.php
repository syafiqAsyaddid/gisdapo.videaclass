<?php
$handle = fopen("public/data/Kecamatan_1.js", "r");
if ($handle) {
    $content = "";
    while (($buffer = fread($handle, 8192)) !== false) {
        $content .= $buffer;
        // Keep buffer size manageable but enough to catch split tokens
        if (strlen($content) > 16384) {
            $content = substr($content, -4096);
        }
        
        if (preg_match_all('/"KECAMATAN"\s*:\s*"([^"]+)"/', $buffer, $matches)) {
            foreach ($matches[1] as $name) {
                echo $name . "\n";
            }
        }
    }
    fclose($handle);
}
