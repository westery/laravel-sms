<?php
/**
 * Created by PhpStorm.
 * User: Odeen
 * Date: 2016/5/12
 * Time: 21:58.
 */

namespace Westery\LaravelSms\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 * Class Sms.
 *
 * @see \Westery\LaravelSms\SmsServiceProvider
 */
class Sms extends LaravelFacade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Sms';
    }
}
