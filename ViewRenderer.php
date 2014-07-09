<?php
namespace yii\tal;
/**
 *  * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

use PHPTAL as Tal;
use Yii;
use yii\base\View;
use yii\base\ViewRenderer as BaseViewRenderer;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Class ViewRenderer
 * TalViewRenderer allows you to use PhpTal templates in views.
 *
 * @author Derick Fynn <dcfynn@vodamail.co.za>
 * @since 2.0
 * @package yii\tal
 */
class ViewRenderer extends BaseViewRenderer
{
    /**
     * @var string the directory or path alias pointing to where Tal cache will be stored.
     */
    public $cachePath = '@runtime/cache/Tal';
    public $mode = Tal::HTML5;
    public $encoding = 'UTF-8';
    public $ext;
    public $postFilter;
    public $source;
    public $template;
    public $templateRepository;
    /**
     * @var Tal
     */
    public $tal;

    public function init()
    {
        $this->tal = new Tal();
        $this->tal->setPhpCodeDestination(Yii::getAlias($this->cachePath));
    }

    /**
     * Renders a view file.
     *
     * This method is invoked by [[View]] whenever it tries to render a view.
     * Child classes must implement this method to render the given view file.
     *
     * @param View $view the view object used for rendering the file.
     * @param string $file the view file.
     * @param array $params the parameters to be passed to the view file.
     *
     * @return string the rendering result
     */
    public function render($view, $file, $params)
    {
        $this->tal->setTemplate($file);
        $this->tal->set('app', Yii::$app);
        $this->tal->set('this', $view);
        if (ArrayHelper::isAssociative($params)) {
            foreach ($params as $key => $value) {
                $this->tal->{$key} = $value;
            }
        }
        // execute the template and render the result in a 'secure' way
        try {
            $render = $this->tal->execute();
        } catch (Exception $e) {
            throw new \HttpException(400, $e->getMessage());
        }

        return $render;
    }
}