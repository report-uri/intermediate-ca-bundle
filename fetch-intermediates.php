<?php
declare(strict_types=1);

$csv = file_get_contents('https://ccadb-public.secure.force.com/mozilla/PublicAllIntermediateCertsWithPEMCSV');
if ($csv === false) {
    throw new \Exception("Could not get certificates");
}

$data = str_getcsv($csv);

$maybeCerts = array_map(
    function (string $item) {
        $start = strpos($item, '-----BEGIN CERTIFICATE-----');

        if ($start === false) {
            return null;
        }

        $end = strpos($item, '-----END CERTIFICATE-----', $start) + 25;

        return substr($item, $start, $end - $start);
    },
    $data
);

$certs = array_filter(
    $maybeCerts,
    function($item) : bool {
        return $item !== null;
    }
);

$text = implode("\r\n\r\n", $certs)."\r\n\r\n";
file_put_contents(__DIR__ . '/res/intermediate-ca-bundle.pem', $text);
