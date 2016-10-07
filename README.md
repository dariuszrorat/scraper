# Kohana HTML scraper module

This module is used to perform HTML DOM parsing.

## Requirements

This module using simplehtmldom as vendor from:

http://simplehtmldom.sourceforge.net/

## Example:

Get plain text from URL:

```php
        $url = 'http://www.example.com';
        $text = Scraper::factory($url)
            ->execute()
            ->as_plaintext();

        $this->response->headers('Content-Type', 'text/plain');
        $this->response->body($text);
```

Get plain text from URL response as string:

```php
        $url = 'http://www.example.com';
        $response = Request::factory($url)
            ->execute();

        $text = Scraper::factory($response, Scraper::FROM_STRING)
            ->execute()
            ->as_plaintext();

        $this->response->headers('Content-Type', 'text/plain');
        $this->response->body($text);
```

Get all anchor data:

```php
        $url = 'http://www.example.com';
        $anchors = Scraper::factory($url)
            ->execute()
            ->get('a');

        foreach($anchors as $a)
        {
            echo $a->href . '<br>';
        }
```


## Config

Currently nothing todo

scraper.php

```php
return array(
);

```
