<?php

namespace App\Services;

class UrlValidationService
{
    /**
     * Проверка URL на SSRF-уязвимости
     */
    public function validateUrl(string $url): bool
    {
        // Базовое форматирование
        $url = $this->normalizeUrl($url);
        
        // Проверяем, что URL валидный
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }
        
        // Получаем хост
        $host = parse_url($url, PHP_URL_HOST);
        
        // Проверяем IP-адрес хоста
        $ip = gethostbyname($host);
        
        // Запрещенные IP-диапазоны (локальные и частные сети)
        $forbiddenRanges = [
            '127.0.0.0/8',      // localhost
            '10.0.0.0/8',       // private network
            '172.16.0.0/12',    // private network
            '192.168.0.0/16',   // private network
            '169.254.0.0/16',   // link-local
            '0.0.0.0/8',        // current network
            '::1/128',          // localhost IPv6
            'fc00::/7',         // private IPv6
            'fe80::/10',        // link-local IPv6
        ];
        
        foreach ($forbiddenRanges as $range) {
            if ($this->ipInRange($ip, $range)) {
                return false;
            }
        }
        
        // Дополнительная проверка: убеждаемся, что хост не резолвится во внутренний IP
        // Это защита от DNS rebinding
        $resolvedIps = dns_get_record($host, DNS_A);
        foreach ($resolvedIps as $record) {
            foreach ($forbiddenRanges as $range) {
                if ($this->ipInRange($record['ip'], $range)) {
                    return false;
                }
            }
        }
        
        return true;
    }
    
    /**
     * Нормализация URL
     */
    private function normalizeUrl(string $url): string
    {
        $url = trim($url);
        
        // Добавляем https:// если нет протокола
        if (!preg_match('/^https?:\/\//i', $url)) {
            $url = 'https://' . $url;
        }
        
        return $url;
    }
    
    /**
     * Проверка, входит ли IP в CIDR диапазон
     */
    private function ipInRange(string $ip, string $range): bool
    {
        if (strpos($range, '/') === false) {
            return $ip === $range;
        }
        
        list($subnet, $mask) = explode('/', $range);
        
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return $this->ipv4InRange($ip, $subnet, $mask);
        }
        
        return $this->ipv6InRange($ip, $subnet, $mask);
    }
    
    /**
     * Проверка IPv4 в диапазоне
     */
    private function ipv4InRange(string $ip, string $subnet, int $mask): bool
    {
        $ipLong = ip2long($ip);
        $subnetLong = ip2long($subnet);
        $maskLong = -1 << (32 - $mask);
        
        return ($ipLong & $maskLong) === ($subnetLong & $maskLong);
    }
    
    /**
     * Проверка IPv6 в диапазоне (упрощенная)
     */
    private function ipv6InRange(string $ip, string $subnet, int $mask): bool
    {
        // Для простоты считаем, что IPv6 адреса из запрещенных диапазонов недопустимы
        $forbiddenNetworks = ['::1', 'fc00::', 'fe80::'];
        
        foreach ($forbiddenNetworks as $network) {
            if (strpos($ip, $network) === 0) {
                return true;
            }
        }
        
        return false;
    }
}