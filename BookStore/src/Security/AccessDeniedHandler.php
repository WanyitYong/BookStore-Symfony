<?php
namespace App\Security;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    private $twig;
    private $logger;

    public function __construct(ContainerInterface $container, LoggerInterface $logger)
    {
        $this->twig = $container->get('twig');
        $this->logger = $logger;
    }

    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        $this->logger->error('Access Denied Exception');

        $template = 'error/accessDenied.html.twig';
        $args = [];
        $html = $this->twig->render($template, $args);
        return new Response($html);
    }
}