<?php
$handle = fopen("public/data/Kecamatan_1.js", "r");
$out = fopen("kecamatans.txt", "w");
if ($handle) {
    $buffer = "";
    while(false !== ($char = fgetc($handle))) {
        $buffer .= $char;
        if (strlen($buffer) > 200) { // Keep buffer small, looking for "KECAMATAN": "NAME"
             $buffer = substr($buffer, -100);
        }
        if (preg_match('/"KECAMATAN"\s*:\s*"([^"]+)"$/', $buffer, $matches)) {
             fwrite($out, $matches[1] . "\n");
             $buffer = ""; // Reset to avoid double match (though $ anchored)
        }
    }
    fclose($handle);
    fclose($out);
}
