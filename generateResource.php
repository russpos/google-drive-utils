<?php

$opts = getopt('hu:');
$usage = <<<USAGE
generateResource

-h        Show help message (this)
-u <url>  Url to scrape resource data from

USAGE;

if (isset($opts['h']) || empty($opts['u'])) {
    echo $usage;
    exit(1);
}
$url = $opts['u'];

$data = file_get_contents($url);
list($pre_table, $table_and_post_table) = explode('<table class="matchpre"', $data);
list($garbage, $most_of_table_and_post) = explode('</thead>', $table_and_post_table);
list($table_body, $post_table) = explode('</table>', $most_of_table_and_post);
$table = trim($table_body);

$parsed = new SimpleXMLElement($table);
print_r($parsed);
echo "Name: ".$parsed->getName()."\n";
foreach ($parsed->children() as $child) {
    echo "> Name: ".$child->getName()."\n";
    foreach ($child->children() as $td) {
        echo "> > Name: ".$td->getName()."\n";
        print_r($td);
        print_r($td->asXML());
    }
}
