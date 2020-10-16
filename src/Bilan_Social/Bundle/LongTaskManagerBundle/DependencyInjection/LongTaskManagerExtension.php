<?php
namespace Bilan_Social\Bundle\LongTaskManagerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

class LongTaskManagerExtension extends Extension
{
	public function load(array $configs, ContainerBuilder $container)
	{
		$configuration = new Configuration();
	    $config = $this->processConfiguration($configuration, $configs);
	    
	    $loader = new YamlFileLoader($container, new FileLocator(dirname(__DIR__).'/Resources/config'));
	    //$loader->load('services.yaml');
	    $loader->load('config.yaml');
	    
	    

/*	    $definition = $container->getDefinition('acme.social.twitter_client');
	    $definition->replaceArgument(0, $config['twitter']['client_id']);
	    $definition->replaceArgument(1, $config['twitter']['client_secret']);
*/	}
    public function getConfiguration(array $config, ContainerBuilder $container)
    {
        return new Configuration();
    }
}
?>