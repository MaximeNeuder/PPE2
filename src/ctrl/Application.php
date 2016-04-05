<?php

namespace RallyeLecture\ctrl;

class Application extends \Slim\Slim {
    public function __construct(array $userSettings = array()) {
        parent::__construct($userSettings);

        /*** Configuration ****************************************************/
        // définit le moteur utilisé pour les vues voir la doc : http://twig.sensiolabs.org
        $this->view = new \Slim\Views\Twig();
        // où se trouvent les templates des vues
        $this->view->setTemplatesDirectory("../src/view");

        // pre-application hook, performs stuff before real action happens @see http://docs.slimframework.com/#Hooks
        $this->hook('slim.before', function () {
            // SASS-to-CSS compiler @see https://github.com/panique/php-sass
            \SassCompiler::run("scss/", "css/");

            // CSS minifier @see https://github.com/matthiasmullie/minify
            $minifier = new \MatthiasMullie\Minify\CSS('css/style.css');
            $minifier->minify('css/style.css');

            // JS minifier @see https://github.com/matthiasmullie/minify
            // DON'T overwrite your real .js files, always save into a different file
            // $minifier = new MatthiasMullie\Minify\JS('js/application.js');
            // $minifier->minify('js/application.minified.js');
        });
    }
}
