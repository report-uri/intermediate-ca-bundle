<?php
declare(strict_types=1);

namespace ReportUri\IntermediateCaBundle\IO;

abstract class CsvRetriever
{
    /**
     * @param string $csvUrl
     * @return string[]
     */
    public static function getArray(string $csvUrl) : array
    {
        $csv = \file_get_contents($csvUrl);

        /**
         * PHP will emit explanatory a warnings if the above fails, we will
         * convert failure to an exception.
         */
        if ($csv === false) {
            throw new NetworkFailure("Could not get specified URL: $csvUrl");
        }

        return \str_getcsv($csv);
    }
}
