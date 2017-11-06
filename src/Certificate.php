<?php
declare(strict_types=1);

namespace ReportUri\IntermediateCaBundle;

class Certificate {
    const BEGIN_MARKER   = '-----BEGIN CERTIFICATE-----';
    const END_MARKER     = '-----END CERTIFICATE-----';
    const END_MARKER_LEN = 25;

    /**
     * @var string
     */
    private $rawValue;

    /**
     * @param string $rawValue
     */
    private function __construct(string $rawValue) {
        $this->rawValue = $rawValue;
    }

    // FIXME: Add ` : ?self` as return hint in PHP 7.1
    /**
     * A constructor wrapper to allow nullable failed constructions.
     *
     * @param string $item
     * @return ?self
     */
    public static function create(string $item) {
        $start = \strpos($item, self::BEGIN_MARKER);

        if ($start === false) { return null; }

        $end = \strpos($item, self::END_MARKER, $start) + self::END_MARKER_LEN;

        return new self(\substr($item, $start, $end - $start));
    }

    /**
     * @param self $cert
     * @return string
     */
    public static function rawValue(self $cert) : string {
        return $cert->rawValue;
    }
}
