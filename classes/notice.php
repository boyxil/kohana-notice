<?php defined('SYSPATH') or die('No direct access allowed.');

class Notice {

    public static function render()
    {
        $session = Session::instance();
        $notice = unserialize($session->get('notice', ''));
        $template = View::factory('notice/default');
        $view ='';
        if (is_array($notice))
        {
            foreach ($notice as $item)
            {
                $message = $item['message'];
                $time = $item['time'];
                $data = $item['data'];
                if (self::is_key($message))
                {
                    $message = Kohana::message('notice', $message);
                }
                if ($data AND is_array($notice))
                {
                    foreach ($data as $key => $value)
                    {
                        $message = str_replace($key, $value, $message);
                    }
                    $view[] = View::factory('notice/item')->set('message', $message)->set('time', $time*1000);
                }
                else
                {
                   $view[] = View::factory('notice/item')->set('message', $message)->set('time', $time*1000);
                }
            }
            $template->set('messages', $view);
            $session->delete('notice');
            return $template->render();
        }
    }

    protected static $notice = array();

    public static function message($message, $time = 10, $data = NULL)
    {
        $session = Session::instance();
        $temp = $session->get('notice', FALSE);
        $array = unserialize($temp);
        if ($temp AND is_array($array))
        {
            self::$notice = $array;
        }
        self::$notice[] = array(
            'message' => $message,
            'time' => $time,
            'data' => $data
        );
        $session->set('notice', serialize(self::$notice));
    }

    protected static function is_key($value)
    {
        $boolean = FALSE;
        if (strstr($value, '#'))
        {
            $boolean = TRUE;
        }
        return $boolean;
    }
}
