<?php
/**
 * BulkSMS PHP implementation
 *
 * @author    Evans Wanguba <ewanguba@gmail.com>
 * @license   http://opensource.org/licenses/MIT
 * @package   evans/bulksms
 */

namespace Evans\BulkSms\Laravel;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for easy access to a BulkSmsService instance.
 */
class BulkSms extends Facade
{
    /**
     * The facade accessor.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bulksms';
    }
}
