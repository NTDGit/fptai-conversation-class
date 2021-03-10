<?php
namespace ntdgit\FPTAI;

class FPT_Chatbot
{
    const VERSION = "1.0.0";
    public $botcode;

    protected $response = array();

    public function __construct($debug = false, $botcode)
    {
        if ((!$debug) && (!isset($_SERVER['HTTP_USER_AGENT']) or strpos($_SERVER['HTTP_USER_AGENT'], 'Apache-HttpAsyncClient') === false))
        {
            exit;
        }
        if (isset($botcode))
        {
            $this->botcode = $botcode;
        }
        else exit;
    }

    public function __destruct()
    {
        if (count($this->response) > 0)
        {
            try
            {
                header('Content-Type: application/json');
                echo json_encode(array(
                    "channel" => "api",
                    "app_code" => $this->botcode,
                    'messages' => $this->response,
                    "sender_id" => "sender_id_abc"
                ));
                exit;
            }
            catch(Exception $e)
            {
                // nothing
                
            }
        }
    }

    /******** FUNCTION *********/
    private function isURL($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    private function sendAttachment($type, $payload)
    {
        $type = strtolower($type);
        $validTypes = array(
            'image',
            'textcard',
            'text',
            'carousel'
        );
        if (in_array($type, $validTypes))
        {
            $this->response[] = array(
                'type' => $type,
                'content' => $payload
            );
        }
        else
        {
            $this->response[] = array(
                'text' => 'Error: Invalid type!'
            );
        }
    }

    public function sendText($messages = null)
    {
        if (is_null($messages))
        {
            throw new Exception('Chưa nhập nội dung!', 1);
        }
        $type = gettype($messages);
        if ($type === 'string')
        {
            $this->response[] = array(
                "type" => "text",
                "content" => array(
                    'text' => $messages
                )
            );
        }
        elseif ($type === 'array' || is_array($messages))
        {
            foreach ($messages as $message)
            {
                $this->response[] = array(
                    "type" => "text",
                    "content" => array(
                        'text' => $messages
                    )
                );
            }
        }
        else
        {
            $this->response[] = array(
                "type" => "text",
                "content" => array(
                    'text' => "Lỗi"
                )
            );
        }
    }

    public function sendImage($url, $title = null)
    {
        if (is_null($title))
        {
            if ($this->isURL($url))
            {
                $this->sendAttachment('image', array(
                    'url' => $url
                ));
            }
            else
            {
                $this->sendText('Error: Invalid URL!');
            }
        }
        else
        {
            // KHẢ DỤNG TRÊN NỀN WEB //
            if ($this->isURL($url))
            {
                $this->sendAttachment('image', array(
                    'title' => $title,
                    'url' => $url
                ));
            }
            else
            {
                $this->sendText('Error: Invalid URL!');
            }
        }
    }

    public function sendTextCard($text, $buttons)
    {
        if (is_array($buttons))
        {
            $this->sendAttachment('text', array(
                'text' => $text,
                'buttons' => $buttons
            ));

            return true;
        }

        return false;
    }

    public function createButtonToBlock($title, $block, $setAttributes = NULL)
    {
        $button = array();
        $button['title'] = $title;
        if (is_array($block))
        {
            if (!is_null($setAttributes) && is_array($setAttributes))
            {
                $json = array(
                    "set_attributes" => $setAttributes
                );
                $json = json_encode($json);
                $json = base64_encode($json);
                $button['payload'] = $block . '#' . $json;
            }
            else $button['payload'] = $block;
        }
        else
        {
            if (!is_null($setAttributes) && is_array($setAttributes))
            {
                $json = array(
                    "set_attributes" => $setAttributes
                );
                $json = json_encode($json);
                $json = base64_encode($json);
                $button['payload'] = $block . '#' . $json;
            }
            else $button['payload'] = $block;
        }
        return $button;
    }

    public function createButtonToURL($title, $url)
    {
        $button = array();

        $button['title'] = $title;

        if (is_array($url))
        {
            $button['url'] = $url;
        }
        else $button['url'] = $url;

        return $button;
    }

    public function createQuickReply($text, $quickReplies)
    {
        if (is_array($quickReplies))
        {
            $this->response[] = array(
                'type' => 'quick_reply',
                'content' => array(
                    'text' => $text,
                    'buttons' => $quickReplies
                )
            );
            return true;
        }
        return false;
    }

    public function createQuickReplyButton($title, $block, $setAttributes = NULL)
    {
        $button = array();
        $button['title'] = $title;

        if (is_array($block))
        {
            if (!is_null($setAttributes) && is_array($setAttributes))
            {
                $json = array(
                    "set_attributes" => $setAttributes
                );
                $json = json_encode($json);
                $json = base64_encode($json);
                $button['payload'] = $block . '#' . $json;
            }
            else $button['payload'] = $block;
        }
        else
        {
            if (!is_null($setAttributes) && is_array($setAttributes))
            {
                $json = array(
                    "set_attributes" => $setAttributes
                );
                $json = json_encode($json);
                $json = base64_encode($json);
                $button['payload'] = $block . '#' . $json;
            }
            else $button['payload'] = $block;
        }

        return $button;
    }

    public function sendCarousel($carousel)
    {
        $carousel = array(
            $carousel
        );
        $this->sendAttachment('carousel', array(
            'carousel_cards' => $carousel
        ));
    }

    public function creatCarousel($image_url, $subtitle, $title, $button, $item_url = "")
    {
        return array(
            "image_url" => $image_url,
            "subtitle" => $subtitle,
            "title" => $title,
            "item_url" => $item_url,
            "buttons" => $button
        );
    }

}

?>
