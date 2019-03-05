<?php
namespace Engine\Librarys;

/**
*	View class for templates
*/
class View 
{
	private $twig;

	private $theme_dir;

	public function __construct(string $theme)
	{
		$this->theme_dir['ThemeDir'] = ROOT.'engine/Resource/Themes/'.$theme.'/';

		$loader = new \Twig_Loader_Filesystem($this->theme_dir['theme-dir']);

		$this->twig = new \Twig_Environment($loader, [
			//'cache' => ROOT.'engine/Cache/Twig',
			'cache' => false,
			'debug' => true,
		]);
	}

	public function render(string $filename, array $params) 
	{		
		echo $this->twig->render($filename.'.html.twig', $params);
	}
}