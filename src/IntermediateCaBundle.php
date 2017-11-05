<?php

/*
 * This file is part of report-uri/intermediate-ca-bundle.
 */

namespace ReportUri\IntermediateCaBundle;

class IntermediateCaBundle
{
    /**
     * Returns the path to the bundled Intermediate CA file
     *
     * @return string path to a Intermediate CA bundle file
     */
    public static function getBundledIntermediateCaBundlePath()
    {
        return __DIR__.'/../res/intermediate-ca-bundle.pem';
    }
}
