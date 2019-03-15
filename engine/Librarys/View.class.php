<?php
namespace Engine\Librarys;

/**
*	View class for templates
*/
class View 
{
	/**
	 * Twig object
	 *
	 * @var object Twig
	 */
	private $twig;

	/**
	 * Theme params
	 *
	 * @var array
	 */
	private $params = [];

	/**
	 * Constructor
	 *
	 * @param string $theme
	 */
	public function __construct(string $theme)
	{
		$this->params['Name'] = $theme;
		$this->params['Directory'] = ROOT.'engine/Resource/Themes/'.$theme.'/';

		$loader = new \Twig_Loader_Filesystem($this->params['Directory']);

		$this->twig = new \Twig_Environment($loader, [
			//'cache' => ROOT.'engine/Cache/Twig',
			'cache' => false,
			'debug' => true,
		]);

		$this->registerFunctions();
	}

	/**
	 * Render page
	 *
	 * @param string $filename
	 * @param array $params
	 * @return void
	 */
	public function render(string $filename, array $params): void 
	{		
		echo $this->twig->render($filename.'.html.twig', $params);
	}

	/**
	 * Get param of config
	 *
	 * @param string $name
	 * @return string|null
	 */
	public function getParam(string $name): ?string
	{
		return $this->params[$name] ?? null;
	}

	/**
	 * Register function for Twig
	 *
	 * @return void
	 */
	private function registerFunctions(): void 
	{
		$this->twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) {
			return sprintf('../assets/%s', ltrim($asset, '/'));
		}));
	}
}