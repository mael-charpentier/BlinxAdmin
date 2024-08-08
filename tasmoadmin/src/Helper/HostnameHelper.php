<?php

namespace TasmoAdmin\Helper;

class HostnameHelper
{
    public const MAX_IPS = 1024;

    public function fetchHostnames(string $hostnameBase, string $fromId, string $toId, array $excludedHostnames = []): array
    {
        

        $fromIdInt = (int)$fromId;
        $toIdInt = (int)$toId;

        if (abs($fromIdInt - $toIdInt) > self::MAX_IPS) {
            throw new \InvalidArgumentException('The defined ID range is too large, please specify a smaller range');
        }

        $hostnames = [];
        for ($id = $fromIdInt; $id <= $toIdInt; $id++) {
            $hostname = str_replace("%i", $this->longId($id, 3), $hostnameBase) . ".local";
            if (in_array($hostname, $excludedHostnames, true)) {
                continue;
            }

            $hostnames[] = $hostname;
        }

        return $hostnames;
    }

    private function longId(int $id, int $l): string
    {
        $t = "";
        for($i = 1; $i < $l; $i++){
            if($id < pow(10, $i)){
                $t .= "0";
            }
        }
        return $t . $id;
    }
}
