<?php
/**
 * BulkSMS PHP implementation
 *
 * @author    Evans Wanguba <ewanguba@gmail.com>
 * @license   http://opensource.org/licenses/MIT
 * @package   evans/bulksms
 */

namespace Evans\BulkSms\Laravel;

use Illuminate\Support\Facades\View;

/**
 * The main API class.
 */
class BulkSmsService extends \Evans\BulkSms\BulkSmsService
{
    /**
     * Send a view with data to a recipient. Made to imitate Laravel's
     * Mail::send syntax.
     *
     * @param  string $view
     * @param  array  $data
     * @param  string $recipient Phone number
     *
     * @return mixed
     */
    public function send($view, $data, $recipient)
    {
        $message = View::make($view, $data)->render();

        return $this->sendMessage($recipient, $message);
    }
}
