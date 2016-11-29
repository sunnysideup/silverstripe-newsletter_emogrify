<?php

class EmogrifierMailer extends Mailer
{
    private static $css_file = '';

    public function sendHTML($to, $from, $subject, $htmlContent, $attachedFiles = false, $customheaders = false, $plainContent = false)
    {
        $cssFileLocation = Director::baseFolder() . Config::inst()->get("EmogrifierMailer", "css_file");
        $cssFileHandler = fopen($cssFileLocation, 'r');
        $css = fread($cssFileHandler,  filesize($cssFileLocation));
        fclose($cssFileHandler);
        $emog = new \Pelago\Emogrifier($htmlContent, $css);
        $htmlContent = $emog->emogrify();
        return parent::sendHTML($to, $from, $subject, $htmlContent, $attachedFiles, $customheaders, $plainContent);
    }
}
