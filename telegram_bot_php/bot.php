<?php

require 'vendor/autoload.php';

use Telegram\Bot\Api;

// Замените 'YOUR_BOT_TOKEN' на реальный токен вашего бота
// Рекомендуется хранить токен в переменной окружения или конфигурационном файле
$telegram = new Api('YOUR_BOT_TOKEN');

// Получаем входящее обновление (например, от вебхука)
$update = $telegram->getWebhookUpdate();

// Проверяем, есть ли сообщение и текст в нем
if ($update->getMessage() && $update->getMessage()->getText()) {
    $message = $update->getMessage();
    $chatId = $message->getChat()->getId();
    $text = $message->getText();

    // Обработка команды /start
    if ($text === '/start') {
        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => 'Привет! Я твой новый Телеграм бот, написанный на PHP.'
        ]);
    }
    // Сюда можно добавить обработку других команд или сообщений
}

// Важно: для работы через вебхуки, этот скрипт должен быть доступен через веб-сервер,
// и адрес этого скрипта должен быть указан в настройках вебхука Telegram.
// Например, https://yourdomain.com/path/to/telegram_bot_php/bot.php

// Для TUNA, вам нужно будет настроить TUNA так, чтобы он перенаправлял запросы от Telegram
// на этот скрипт, запущенный локально (возможно, через встроенный PHP веб-сервер или Docker).

// Пример простого ответа, чтобы Telegram знал, что вебхук получен (не всегда обязательно, зависит от библиотеки)
// http_response_code(200);
// echo "OK";
