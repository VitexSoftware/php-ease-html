![EasePHP Framework HTML Logo](https://raw.githubusercontent.com/VitexSoftware/ease-html/master/project-logo.png "Project Logo")

Ease Framework Html 
===================

[![Latest Version](https://img.shields.io/github/release/VitexSoftware/ease-html.svg?style=flat-square)](https://github.com/VitexSoftware/ease-html/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/VitexSoftware/ease-html/blob/master/LICENSE)
[![Build Status](https://img.shields.io/travis/VitexSoftware/ease-html/master.svg?style=flat-square)](https://travis-ci.org/vitexsoftware/ease-html)
[![Total Downloads](https://img.shields.io/packagist/dt/VitexSoftware/ease-html.svg?style=flat-square)](https://packagist.org/packages/vitexsoftware/ease-html)
[![Latest stable](https://img.shields.io/packagist/v/VitexSoftware/ease-html.svg?style=flat-square)](https://packagist.org/packages/vitexsoftware/ease-html)


 "my way how to assemble web page using PHP Objects."

Basic Example for [HTML5 WebPage](Examples/webpage.php):

```php
$head = new \Ease\Html\HeadTag( new \Ease\Html\TitleTag('Ease WebPage'));

$body = new \Ease\Html\BodyTag(new \Ease\Html\HeaderTag( new \Ease\Html\H1Tag('Web Page')));

$body->addItem( new \Ease\Html\ArticleTag('Example'));

$body->addItem(new \Ease\Html\FooterTag( new \Ease\Html\SmallTag( new \Ease\Html\ATag('v.s.cz','Vitex Software') ) ));

$oPage = new \Ease\Html\HtmlTag([$head,$body]);

echo $oPage;
```

or use the **[WebPage class](Examples/webpageClass.php)**:

```php
$oPage = new \Ease\WebPage('Ease WebPage');

$oPage->addItem(new \Ease\Html\HeaderTag(new \Ease\Html\H1Tag('Web Page')));

$oPage->addItem(new \Ease\Html\ArticleTag('Example'));

$oPage->addItem(new \Ease\Html\FooterTag(new \Ease\Html\SmallTag(new \Ease\Html\ATag('v.s.cz',
                'Vitex Software'))));

echo $oPage;

```


Special Classess
------------

Main Glue of Ease\Html is 


**Ease\Container**

Container can contain simple text,  another object or mix od them.

```php
$group = [ new StrongTag('strong text'), 'simple text ', new DivTag( new HrTag() ) ];

$heap = new Container();
$heap->addItem('text to include');
$heap->addItem( new H1Tag('heading) );
$heap->addItem( $group );
```

**Ease\Document**

Is smarter container able to hold Scripts and cascade styles

```php
$oPage = new Page();

```

and finally:

**Ease\WebPage**

Is Page that include Head and Body elements

```php
$oPage = new \Ease\WebPage('Page title');
$oPage->addItem( new \Ease\Html\ImgTag( 'images/sun.png' );
$oPagr->addJavaScript('alert("Let the sun shine in!")');
echo $oPage;
```


Implemented HTML5 tags:
-----------------------

 * [AddressTag](src/Ease/Html/AddressTag.php)
 * [ArticleTag](src/Ease/Html/ArticleTag.php)
 * [AsideTag](src/Ease/Html/AsideTag.php)
 * [ATag](src/Ease/Html/ATag.php)
 * [AudioTag](src/Ease/Html/AudioTag.php)
 * [BdiTag](src/Ease/Html/BdiTag.php)
 * [BodyTag](src/Ease/Html/BodyTag.php)
 * [ButtonTag](src/Ease/Html/ButtonTag.php)
 * [CanvasTag](src/Ease/Html/CanvasTag.php)
 * [DatalistTag](src/Ease/Html/DatalistTag.php)
 * [DdTag](src/Ease/Html/DdTag.php)
 * [DetailsTag](src/Ease/Html/DetailsTag.php)
 * [DialogTag](src/Ease/Html/DialogTag.php)
 * [DivTag](src/Ease/Html/DivTag.php)
 * [DlTag](src/Ease/Html/DlTag.php)
 * [DtTag](src/Ease/Html/DtTag.php)
 * [EmbedTag](src/Ease/Html/EmbedTag.php)
 * [EmTag](src/Ease/Html/EmTag.php)
 * [FieldSet](src/Ease/Html/FieldSet.php)
 * [FigCaptionTag](src/Ease/Html/FigCaptionTag.php)
 * [FigureTag](src/Ease/Html/FigureTag.php)
 * [FooterTag](src/Ease/Html/FooterTag.php)
 * [Form](src/Ease/Html/Form.php)
 * [HeaderTag](src/Ease/Html/HeaderTag.php)
 * [HeadTag](src/Ease/Html/HeadTag.php)
 * [HrTag](src/Ease/Html/HrTag.php)
 * [HtmlTag](src/Ease/Html/HtmlTag.php)
 * [H1Tag](src/Ease/Html/H1Tag.php)
 * [H2Tag](src/Ease/Html/H2Tag.php)
 * [H3Tag](src/Ease/Html/H3Tag.php)
 * [H4Tag](src/Ease/Html/H4Tag.php)
 * [CheckboxGroup](src/Ease/Html/CheckboxGroup.php)
 * [CheckboxTag](src/Ease/Html/CheckboxTag.php)
 * [IframeTag](src/Ease/Html/IframeTag.php)
 * [ImgTag](src/Ease/Html/ImgTag.php)
 * [InputColorTag](src/Ease/Html/InputColorTag.php)
 * [InputContainer](src/Ease/Html/InputContainer.php)
 * [InputDateTag](src/Ease/Html/InputDateTag.php)
 * [InputDateTimeLocalTag](src/Ease/Html/InputDateTimeLocalTag.php)
 * [InputDateTimeTag](src/Ease/Html/InputDateTimeTag.php)
 * [InputEmailTag](src/Ease/Html/InputEmailTag.php)
 * [InputFileTag](src/Ease/Html/InputFileTag.php)
 * [InputHiddenTag](src/Ease/Html/InputHiddenTag.php)
 * [InputMonthTag](src/Ease/Html/InputMonthTag.php)
 * [InputNumberTag](src/Ease/Html/InputNumberTag.php)
 * [InputPasswordTag](src/Ease/Html/InputPasswordTag.php)
 * [InputRadioTag](src/Ease/Html/InputRadioTag.php)
 * [InputRangeTag](src/Ease/Html/InputRangeTag.php)
 * [InputSearchTag](src/Ease/Html/InputSearchTag.php)
 * [InputSubmitTag](src/Ease/Html/InputSubmitTag.php)
 * [InputTag](src/Ease/Html/InputTag.php)
 * [InputTelTag](src/Ease/Html/InputTelTag.php)
 * [InputTextTag](src/Ease/Html/InputTextTag.php)
 * [InputTimeTag](src/Ease/Html/InputTimeTag.php)
 * [InputUrlTag](src/Ease/Html/InputUrlTag.php)
 * [InputWeekTag](src/Ease/Html/InputWeekTag.php)
 * [JavaScript](src/Ease/Html/JavaScript.php)
 * [KeygenTag](src/Ease/Html/KeygenTag.php)
 * [LabelTag](src/Ease/Html/LabelTag.php)
 * [LiTag](src/Ease/Html/LiTag.php)
 * [MainTag](src/Ease/Html/MainTag.php)
 * [MarkTag](src/Ease/Html/MarkTag.php)
 * [MenuItemTag](src/Ease/Html/MenuItemTag.php)
 * [MetaTag](src/Ease/Html/MetaTag.php)
 * [MeterTag](src/Ease/Html/MeterTag.php)
 * [NavTag](src/Ease/Html/NavTag.php)
 * [OlTag](src/Ease/Html/OlTag.php)
 * [OptionTag](src/Ease/Html/OptionTag.php)
 * [OutputTag](src/Ease/Html/OutputTag.php)
 * [PairTag](src/Ease/Html/PairTag.php)
 * [ParamTag](src/Ease/Html/ParamTag.php)
 * [PreTag](src/Ease/Html/PreTag.php)
 * [ProgressTag](src/Ease/Html/ProgressTag.php)
 * [PTag](src/Ease/Html/PTag.php)
 * [RadiobuttonGroup](src/Ease/Html/RadiobuttonGroup.php)
 * [RpTag](src/Ease/Html/RpTag.php)
 * [RtTag](src/Ease/Html/RtTag.php)
 * [RubyTag](src/Ease/Html/RubyTag.php)
 * [ScriptTag](src/Ease/Html/ScriptTag.php)
 * [SectionTag](src/Ease/Html/SectionTag.php)
 * [Select](src/Ease/Html/Select.php)
 * [SelectTag](src/Ease/Html/SelectTag.php)
 * [SimpleHeadTag](src/Ease/Html/SimpleHeadTag.php)
 * [SmallTag](src/Ease/Html/SmallTag.php)
 * [SourceTag](src/Ease/Html/SourceTag.php)
 * [Span](src/Ease/Html/Span.php)
 * [SpanTag](src/Ease/Html/SpanTag.php)
 * [StrongTag](src/Ease/Html/StrongTag.php)
 * [SubmitButton](src/Ease/Html/SubmitButton.php)
 * [SummaryTag](src/Ease/Html/SummaryTag.php)
 * [SvgTag](src/Ease/Html/SvgTag.php)
 * [TableTag](src/Ease/Html/TableTag.php)
 * [Tag](src/Ease/Html/Tag.php)
 * [Tbody](src/Ease/Html/Tbody.php)
 * [TdTag](src/Ease/Html/TdTag.php)
 * [TextareaTag](src/Ease/Html/TextareaTag.php)
 * [Tfoot](src/Ease/Html/Tfoot.php)
 * [Thead](src/Ease/Html/Thead.php)
 * [ThTag](src/Ease/Html/ThTag.php)
 * [TimeTag](src/Ease/Html/TimeTag.php)
 * [TitleTag](src/Ease/Html/TitleTag.php)
 * [TrackTag](src/Ease/Html/TrackTag.php)
 * [TrTag](src/Ease/Html/TrTag.php)
 * [UlTag](src/Ease/Html/UlTag.php)
 * [VideoTag](src/Ease/Html/VideoTag.php)
 * [WbrTag](src/Ease/Html/WbrTag.php)

Installation
------------


```
composer require vitexsoftware/ease-html
```

