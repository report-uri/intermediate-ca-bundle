<?php
declare(strict_types=1);

namespace ReportUri\IntermediateCaBundle\IO;

use ReportUri\IntermediateCaBundle\Certificate;

abstract class Output
{
    const DELIMITER = "\r\n\r\n";

    /**
     * @param Certificate ...$certs
     * @return string
     */
    public static function serialiseCerts(Certificate ...$certs) : string
    {
        $certStrings = array_map([Certificate::class, 'rawValue'], $certs);

        return implode(self::DELIMITER, $certStrings) . self::DELIMITER;
    }

    public static function writeTo(string $file, Certificate ...$certs)
    {
        file_put_contents($file, self::serialiseCerts(...$certs));
    }
}
