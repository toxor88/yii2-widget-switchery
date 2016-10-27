yii2-widget-switchery
======================

[![Latest Stable Version](https://poser.pugx.org/toxor88/yii2-widget-switchery/v/stable)](https://packagist.org/packages/toxor88/yii2-widget-switchery)
[![License](https://poser.pugx.org/toxor88/yii2-widget-switchery/license)](https://packagist.org/packages/toxor88/yii2-widget-switchery)
[![Total Downloads](https://poser.pugx.org/toxor88/yii2-widget-switchery/downloads)](https://packagist.org/packages/toxor88/yii2-widget-switchery)
[![Monthly Downloads](https://poser.pugx.org/toxor88/yii2-widget-switchery/d/monthly)](https://packagist.org/packages/toxor88/yii2-widget-switchery)
[![Daily Downloads](https://poser.pugx.org/toxor88/yii2-widget-switchery/d/daily)](https://packagist.org/packages/toxor88/yii2-widget-switchery)

iOS Switchery Slider (http://abpetkov.github.io/switchery/)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/). Check the [composer.json](https://github.com/toxor88/yii2-widget-switchery/blob/master/composer.json) for this extension's requirements and dependencies.

To install, either run

```
$ php composer.phar require toxor88/yii2-widget-switchery "*"
```

or add

```
"toxor88/yii2-widget-switchery": "*"
```

to the ```require``` section of your `composer.json` file.

## Demo

You can refer detailed [documentation and demos](http://abpetkov.github.io/switchery/) on usage of the extension.

## Usage

```php
use toxor88\switchery\Switchery;
use yii\web\JsExpression;

// usage without model
echo '<label>Can do something?</label>';
echo Switchery::widget([
	'name' => 'can_do_something', 
	'clientOptions' => [
		'color'              => '#64bd63',
		'secondaryColor'     => '#dfdfdf',
        'jackColor'          => '#fff',
        'jackSecondaryColor' => null,
        'className'          => 'switchery',
        'disabled'           => false,
        'disabledOpacity'    => 0.5,
        'speed'              => '0.1s',
        'size'               => 'default',
	],
    'clientChangeEvent' => new JsExpression('function() {
        alert("checked: " + this.checked);
    }'),
]);

// usage with model
$form->model($model, 'attribute')->widget(Switchery::className(), [ /* widget options... */ ]);

// if you use the defualt ActiveField template, there can be multiple labels. To avoid it use:
// the label displays after the slider:
$form->model($model, 'attribute')->widget(Switchery::className(), [ /* widget options... */ ])->label(false);

// the label displays before the slider:
$form->model($model, 'attribute')->widget(Switchery::className(), [ 'options' => 'label' => null ])->label('label text or inherited from model');
```

## License

**yii2-widget-switchery** is released under the BSD 3-Clause License. See the bundled `LICENSE` for details.
