<?php namespace EvolutionCMS\SeriousCustom;

use EvolutionCMS\Interfaces\CoreInterface;
use EvolutionCMS\Models\SiteTemplate;
use EvolutionCMS\TemplateProcessor;

class SeriousTemplateProcessor extends TemplateProcessor
{

    public function getBladeDocumentContent()
    {
        $template = false;
        $doc = $this->core->documentObject;
        $templateAlias = SiteTemplate::select('templatealias')->find($doc['template'])->templatealias;

        switch (true) {
            case $this->core['view']->exists('tpl-' . $doc['template'] . '_doc-' . $doc['id']):
                $template = 'tpl-' . $doc['template'] . '_doc-' . $doc['id'];
                break;
            case $this->core['view']->exists('doc-' . $doc['id']):
                $template = 'doc-' . $doc['id'];
                break;
            case $this->core['view']->exists('tpl-' . $doc['template']):
                $template = 'tpl-' . $doc['template'];
                break;
            case $this->core['view']->exists($templateAlias):
                $className = 'Serious\\Controllers\\' . ucfirst($templateAlias) . 'Controller';
                if (class_exists($className)) {
                    $customClass = new $className();
                    $customClass->render();
                }
                $template = $templateAlias;
                break;
            default:
                $content = $doc['template'] ? $this->core->documentContent : $doc['content'];
                if (!$content) {
                    $content = $doc['content'];
                }
                if (strpos($content, '@FILE:') === 0) {
                    $template = str_replace('@FILE:', '', trim($content));
                    if (!$this->core['view']->exists($template)) {
                        $this->core->§documentObject['template'] = 0;
                        $this->core->documentContent = $doc['content'];
                    }
                }
        }
        return $template;
    }
}
