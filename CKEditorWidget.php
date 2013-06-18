<?php
/**
 * Simple Yii CKEditor widget
 * @property string $configJS
 * @property string $assetsPath
 * @property string $assetsUrl
 * @author Yuriy Firs <firs.yura@gmail.com>
 * @version 0.1.1
 */ 
class CKEditorWidget extends CInputWidget {
    /**
     * Assets package ID.
     */
    const PACKAGE_ID = 'ckeditor-widget';

    /**
     * @var array Default config
     */
    public $config = array(
        // You can set your default config
        //'language' => 'ru',
    );

    public $package = array();

    /**
     * Init widget.
     */
    public function init()
    {
        parent::init();

        $this->package = array(
            'baseUrl' => $this->assetsUrl,
            'js' => array(
                'ckeditor.js',
            )
        );

        $this->registerClientScript();
    }

    /**
     * Register CSS and Script.
     */
    protected function registerClientScript()
    {
        Yii::app()->clientScript
            ->addPackage(self::PACKAGE_ID, $this->package)
            ->registerPackage(self::PACKAGE_ID)->registerScript(
                $this->id,
                "CKEDITOR.editorConfig = function( config ) {
                ".$this->configJS."
                };",
                Yii::app()->clientScript->coreScriptPosition
            );
    }

    /**
     * Get the assets path.
     * @return string
     */
    public function getAssetsPath()
    {
        return __DIR__ . '/assets';
    }

    /**
     * Print activeTextArea
     */
    public function run()
    {
        // add class ckeditor
        if (array_key_exists('class', $this->htmlOptions) && strpos($this->htmlOptions['class'], 'ckeditor') === false) {
            $this->htmlOptions['class'] .= ' ckeditor';
        } elseif (!array_key_exists('class', $this->htmlOptions))
            $this->htmlOptions['class'] = 'ckeditor';
        echo CHtml::activeTextArea($this->model,$this->attribute,$this->htmlOptions);
    }

    /**
     * Publish assets and return url.
     * @return string
     */
    public function getAssetsUrl()
    {
        return Yii::app()->assetManager->publish($this->assetsPath);
    }

    /**
     * Convert config array to config string
     * @return string
     */
    public function getConfigJS()
    {
        $return = '';
        foreach ($this->config as $key=>$value) {
            $return .= "config.".$key." = ".json_encode($value)."; ";
        }
        return $return;
    }
}
