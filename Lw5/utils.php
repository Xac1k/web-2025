<?php
function getOrDefault(&$value, $default): mixed
{
    return isset($value) ? $value : $default;
}

function getUserInfo(array $users, string $id): array|bool
{
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            $name = getOrDefault($user['name'], null);
            $img_avatar = getOrDefault($user['img_avatar'], FILE_ERROR_UNKNOWN_USER);
            $description = getOrDefault($user['description'], null);

            return [
                'name' => $name,
                'image' => $img_avatar,
                'description' => $description
            ];
        }
    }
    return false;
}

function isImageFormatSupported(?string &$url): bool
{
    if (!isset($url)) return false;
    return preg_match('/^\w+.png$/u', $url);
}