<?php

    namespace MOMook\Propel\Generator\Builder\Om;

    use Propel\Generator\Builder\Om\AbstractOMBuilder AS ParentAbstractOMBuilder;
    use Propel\Generator\Builder\Util\PropelTemplate;

    /**
     * Class AbstractOMBuilder
     * @package MOMook\Propel\Generator\Builder\Om
     */
    abstract class AbstractOMBuilder extends ParentAbstractOMBuilder
    {

        /**
         * @var string
         */
        protected $templateBasePath = __DIR__;

        /**
         * @return string
         */
        public function getTemplateBasePath()
        {
            return $this->templateBasePath;
        }

        /**
         * @param string $templateBasePath
         */
        public function setTemplateBasePath($templateBasePath)
        {
            $this->templateBasePath = (string)$templateBasePath;
        }

        /**
         * @param string $filename
         * @param array  $vars
         * @param string $templateDir
         *
         * @return string
         * @throws \Exception
         */
        public function renderTemplate($filename, $vars = array(), $templateDir = '/templates/')
        {
            $basePath = $this->getTemplateBasePath();
            $filePath = $basePath . $templateDir . $filename;

            if (!file_exists($filePath)) {

                $filePath = $filePath . '.php';

                if (!file_exists($filePath)) {

                    throw new \InvalidArgumentException(
                        sprintf(
                            'Template "%s" not found in "%s" directory',
                            $filename,
                            $basePath . $templateDir
                        )
                    );
                }
            }

            $template = new PropelTemplate();
            $template->setTemplateFile($filePath);
            $vars = array_merge($vars, ['behavior' => $this]);

            return $template->render($vars);
        }
    }