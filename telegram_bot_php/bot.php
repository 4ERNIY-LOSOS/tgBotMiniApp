<?php

require 'vendor/autoload.php';

use Telegram\Bot\Api;

// Замените 'YOUR_BOT_TOKEN' на реальный токен вашего бота
// Рекомендуется хранить токен в переменной окружения или конфигурационном файле
$telegram = new Api('YOUR_BOT_TOKEN');

// Получаем входящее обновление (например, от вебхука)
// Для корректной работы с вебхуками TUNA, убедитесь, что TUNA настроен
// на перенаправление запросов на этот скрипт.
$update = $telegram->getWebhookUpdate();

// Проверяем, есть ли сообщение и текст в нем
if ($update && $update->getMessage() && $update->getMessage()->getText()) {
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
// TUNA будет предоставлять вам публичный URL, который нужно будет использовать.

// Пример простого ответа, чтобы Telegram знал, что вебхук получен (не всегда обязательно, зависит от библиотеки)
// http_response_code(200);
// echo "OK";
