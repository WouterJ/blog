<?php

namespace Acme\MainBundle\DataFixtures\PHPCR;

use PHPCR\Util\NodeHelper;
use Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Phpcr\Route;
use Symfony\Cmf\Bundle\ContentBundle\Doctrine\Phpcr\StaticContent;
use Doctrine\ODM\PHPCR\Document\Generic;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadContentData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $session = $manager->getPhpcrSession();

        NodeHelper::createPath($session, '/cms/content');
        NodeHelper::createPath($session, '/cms/routes');

        $contentRoot = $manager->find(null, '/cms/content');
        $routesRoot = $manager->find(null, '/cms/routes');

        $route = new Route();
        $route->setPosition($routesRoot, 'one');

        $manager->persist($route);

        $content = new StaticContent();
        $content->setName('content-1');
        $content->setTitle('Content 1');
        $content->setBody('Content 1');
        $content->addRoute($route);
        $route->setContent($content);

        $content->setParent($contentRoot);

        $manager->persist($content);

        $route = new Route();
        $route->setPosition($routesRoot, 'two');

        $manager->persist($route);

        $content = new StaticContent();
        $content->setName('content-2');
        $content->setTitle('Content 2');
        $content->setBody('Content 2');
        $content->setParent($contentRoot);
        $content->addRoute($route);
        $route->setContent($content);

        $manager->persist($content);

        $manager->flush();
    }
}
