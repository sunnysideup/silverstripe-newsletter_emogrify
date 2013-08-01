<?php

class EmogrifierMailer extends Mailer {

	private static $css_file = '/themes/mysite/css/typography.css';
	public static function set_css_file($s){ self::$css_file = $s;}

	function sendHTML($to, $from, $subject, $htmlContent, $attachedFiles = false, $customheaders = false, $plainContent = false, $inlineImages = false) {
		require_once(Director::baseFolder() . '/newsletter_emogrify/thirdparty/Emogrifier.php');
		$cssFileLocation = Director::baseFolder() . self::$css_file;
		$cssFileHandler = fopen($cssFileLocation, 'r');
		$css = fread($cssFileHandler,  filesize($cssFileLocation));
		fclose($cssFileHandler);
		$emog = new Emogrifier($htmlContent, $css);
		$htmlContent = $emog->emogrify();
		return parent::sendHTML($to, $from, $subject, $htmlContent, $attachedFiles, $customheaders, $plainContent, $inlineImages);
	}
}
