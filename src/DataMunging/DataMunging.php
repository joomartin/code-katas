<?php

namespace DataMunging;

class DataMunging
{
    /**
     * @param string $file 
     * @return array
     */
    public function weather($file)
    {
        $content = $this->fetchFile($file, [0, 1]);
        foreach ($content as $i => $item) {
            $output[] = [
                'Dy' => intval($item[0]),
                'mnT' => intval($item[2])
            ];
        }

        return $output;
    }

    /**
     * @param string $file 
     * @return string
     */
    public function football($file)
    {
        $content = $this->fetchFile($file, [0]);
        foreach ($content as $i => $item) {
            $differencesByTeams[] = [
                'team' => $item[1],
                'diff' => $item[6] - $item[8]
            ];
        }

        $min = $differencesByTeams[0];
        foreach ($differencesByTeams as $item) {
            if ($item['diff'] > 0 && $item['diff'] < $min['diff']) {
                $min = $item;
            }
        }

        return $min['team'];
    }

    /**
     * @param string $file 
     * @param array $excludedLines 
     * @return array
     */
    public function fetchFile($file, $excludedLines = [])
    {
        $path = getcwd() . '/src/DataMunging/' . $file;
        $handle = @fopen($path, 'r');
        $content = [];

        if (!$handle) {
            throw new \InvalidArgumentException("File not found: {$file}");
        }

        for ($i = 0; ($line = fgets($handle)) !== false; $i++) {
            if ($excludedLines && in_array($i, $excludedLines)) {
                continue;
            }

            $filteredLine = array_filter(explode(' ', $line));
            $values = array_values($filteredLine);

            if (!is_numeric($values[0])) {
                continue;
            }

            $content[] = $values;
        }

        return $content;
    }
}
