<?php

$certs = array();
$csv = file_get_contents('https://ccadb-public.secure.force.com/mozilla/IncludedCACertificateReportPEMCSV');
$data = str_getcsv($csv);

foreach($data as $item) {
    $start = strpos($item, '-----BEGIN CERTIFICATE-----');
    if($start !== false) {
        $end = strpos($item, '-----END CERTIFICATE-----', $start) + 25;
        $certs[] = substr($item, $start, $end - $start);
    }
}

$text = implode("\r\n\r\n", $certs)."\r\n\r\n";
file_put_contents('root-bundle.crt', $text);

?>