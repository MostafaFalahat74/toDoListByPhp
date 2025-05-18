<?php
namespace Helpers;

class RedirectHelper {
    public static function redirect(string $url): void {
        header("Location: $url");
        exit();
    }
}
