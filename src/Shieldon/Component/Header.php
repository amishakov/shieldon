<?php declare(strict_types=1);
/*
 * This file is part of the Shieldon package.
 *
 * (c) Terry L. <contact@terryl.in>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shieldon\Component;

use Shieldon\IpTrait;

use function implode;
use function preg_match;

/**
 * Robot
 */
class Header extends ComponentProvider
{
    use IpTrait;

    const STATUS_CODE = 83;

    /**
     *  Very common requests from normal users.
     * 
     * @var string
     */
    protected $commonHeaderFileds = [
        'Accept',
        'Accept-Language',
        'Accept-Encoding',
        // 'Cache-Control', (Sometime browers will not send this request header, it is not stable.)
        // 'Upgrade-Insecure-Requests', ( IE doesn't support this..)
    ];

    /**
     * {@inheritDoc}
     */
    public function isDenied(): bool
    {
        $headers = Container::get('request')->getHeaders();

        if (! empty($this->deniedList)) {
            if (preg_match('/(' . implode('|', $this->deniedList). ')/i', implode(',', $headers))) {
                return true;
            }
        }

        if ($this->strictMode) {

            foreach ($this->commonHeaderFileds as $fieldName) {

                // If strict mode is on, this value must be found.
                if (! isset($headers[$fieldName])) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Unique deny status code.
     *
     * @return int
     */
    public function getDenyStatusCode(): int
    {
        return self::STATUS_CODE;
    }
}