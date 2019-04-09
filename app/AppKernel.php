<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Seguridad\AdminBundle\AdminBundle(),
            new Util\cURLBundle\cURLBundle(),
            new Reportes\PDFBundle\PDFBundle(),
            new Transporte\TransporteBundle\TransporteBundle(),
            new Transporte\ControlParqueoBundle\ControlParqueoBundle(),
            new Transporte\ParqueoEventualBundle\ParqueoEventualBundle(),
            new Transporte\CirculacionEventualBundle\CirculacionEventualBundle(),
            new Transporte\PlanificacionBundle\PlanificacionBundle(),
            new Otros\NomencladorBundle\NomencladorBundle(),
            new Otros\TareaOperativaBundle\TareaOperativaBundle(),
            new Indicadores\IndicadorBundle\IndicadorBundle(),
            new Calidad\CalidadBundle\CalidadBundle(),
        );
        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config.yml');
    }
}
