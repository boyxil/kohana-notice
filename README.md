Kohana Notice модуль 
------------

Модуль для отображения уведомлений

![Alt-текст](http://wedesart.net.ua/notice.jpg "Kohana Notice модуль")
 
Показать уведомление: `Notice::render();`

Добавить уведомление: `Notice::message();`

Статический метод `message()` может принимать три параметра:

    message($message, $time, $data );
    
`$message` – текст сообщения (возможно использовать HTML теги). Есть возможность указать специальный индификатор, если строка начинается на знак решетки  #, то текс сообщения берется из messages/notice.php.

`$time` – время длительности показа уведомления (по умолчанию 10 секунд).

`$data` – дополнительные данные для текста уведомления (по умолчанию NULL).

Пример:

    $message  = 'Привет, :name. <br> http://wedesart.net.ua';
    // или $message  = '#001';
    
    Notice::message($message , 3, array(':name' => 'Владимир'));
    // есть возможность вывести несколько сообщений подряд
    
    $this->template->messages = Notice::render();
    // или echo Notice::render();
    
Код JS и CSS уведомления взят здесь http://stanlemon.net/pages/jgrowl