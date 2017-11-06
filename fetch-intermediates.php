<?php
declare(strict_types=1);
namespace ReportUri\IntermediateCaBundle;

if (\is_file(__DIR__.'/vendor/autoload.php')) {
    require_once __DIR__.'/vendor/autoload.php';
} else {
    require_once __DIR__.'/autoload.php';
}

const CERT_LIST_URL = 'https://ccadb-public.secure.force.com/mozilla/'
                    . 'PublicAllIntermediateCertsWithPEMCSV';

$data    = IO\CsvRetriever::getArray(CERT_LIST_URL);
$certs   = \array_filter(\array_map([Certificate::class, 'create'], $data));
$outFile = IntermediateCaBundle::getBundledIntermediateCaBundlePath();

IO\Output::writeTo($outFile, ...$certs);
