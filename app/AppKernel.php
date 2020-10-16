<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel {

    public function registerBundles() {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Bilan_Social\Bundle\ImportBundle\ImportBundle(),
            new Bilan_Social\Bundle\UserBundle\UserBundle(),
            new Bilan_Social\Bundle\CoreBundle\CoreBundle(),
            new Bilan_Social\Bundle\ConsoBundle\ConsoBundle(),
            new Bilan_Social\Bundle\ApaBundle\ApaBundle(),
            new Bilan_Social\Bundle\ReferencielBundle\ReferencielBundle(),
            new Bilan_Social\Bundle\CampagneBundle\CampagneBundle(),
            new Bilan_Social\Bundle\EnqueteBundle\EnqueteBundle(),
            new Bilan_Social\Bundle\CollectiviteBundle\CollectiviteBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new Craue\FormFlowBundle\CraueFormFlowBundle(),
            new WhiteOctober\BreadcrumbsBundle\WhiteOctoberBreadcrumbsBundle(),
            new Bilan_Social\Bundle\BilanSocialBundle\BilanSocialBundle(),
            new Bilan_Social\Bundle\ActualiteBundle\ActualiteBundle(),
            new Bilan_Social\Bundle\FileManagerBundle\FileManagerBundle(),
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            new Bilan_Social\Bundle\FaqBundle\FaqBundle(),
            new Bilan_Social\Bundle\ContactBundle\ContactBundle(),
            new Bilan_Social\Bundle\ModelMailBundle\ModelMailBundle(),
            new Bilan_Social\Bundle\ModelVuesBundle\ModelVuesBundle(),
            new Bilan_Social\Bundle\JasperServerBundle\JasperServerBundle(),
            new Hboie\JasperReportBundle\HboieJasperReportBundle(),
            new Bilan_Social\Bundle\ImportCarriereBundle\ImportCarriereBundle(),
            new Bilan_Social\Bundle\AnalyseBundle\AnalyseBundle(),
            new L3\Bundle\CasBundle\L3CasBundle(),
            //new Snc\RedisBundle\SncRedisBundle(),
            new Bazinga\Bundle\JsTranslationBundle\BazingaJsTranslationBundle(),
            new Exercise\HTMLPurifierBundle\ExerciseHTMLPurifierBundle(),
            new Bilan_Social\Bundle\InfoCentreBundle\InfoCentreBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Bilan_Social\Bundle\TestBundle\TestBundle(),
            new Bilan_Social\Bundle\LongTaskManagerBundle\LongTaskManagerBundle(),
            new MewesK\TwigSpreadsheetBundle\MewesKTwigSpreadsheetBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
            $bundles[] = new Symfony\Bundle\WebServerBundle\WebServerBundle();
        }

        return $bundles;
    }

//    public function registerContainerConfiguration(LoaderInterface $loader) {
//        $loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
//    }

    public function getRootDir()
    {
        return __DIR__;
    }
    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }
    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }


}
