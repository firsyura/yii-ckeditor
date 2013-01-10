CKEditor widget for Yii Framework
============

Simple Yii CKEditor widget.

CKEditor - WYSIWYG editor for everyone.

Widget generate CHtml::activeTextArea with same properties.

Tested with CKEditor 4+ version.

Installation
------------

Copy this widget to Extensions folder.

Download CKEditor from http://ckeditor.com/download

Paste CKEditor's files to extension assets folder.

Usage
-----

First, import the widget class file

```php
Yii::import('ext.yii-ckeditor.CKEditorWidget');
```

Next, call the widget:

```php
$this->widget('CKEditorWidget', array(
	'model' => $model,
	'attribute' => 'field',
	// editor options http://docs.ckeditor.com/#!/api/CKEDITOR.config
	'config' => array(
		'language' => 'ru',
	),
));
```