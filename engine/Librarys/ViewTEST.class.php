<?php 
namespace Engine\Librarys;

/**
*	Render pages
*/
class View {

	/**
	*	Replace container
	*
	*	@var array $replace
	*/
	private $replace = []; 

	/**
	*	Temp view-file path
	*
	*	@var string $tempfilepath
	*/
	private $tempfilepath = null;

	/**
	*	Temp view-file
	*
	*	@var string $tempfilepath
	*/
	private $tempfile = null;
	
	/**
	*	Set key for replace
	*
	*	@param string $key
	*	@param string $value
	*	@return void
	*/
	public function set(string $key, string $value): void {
		$this->replace[$key] = $value;
	}
	
	/**
	*	Render page
	*
	*	@param string $file
	*	@throws Exception
	*	@return void
	*/		
	public function obrender(string $file): void {
		$this->tempfilepath = $this->getThemePath().$file;
		
		if(file_exists($this->tempfilepath)) {
			$tmp = file_get_contents($this->tempfilepath);
			
			if(!empty($this->replace))
				foreach($this->replace as $key => $val)
					$tmp = str_replace('%'.$key.'%', $val, $tmp);
	
			echo $tmp;	
		} else throw new \Exception('1 file '.$this->tempfilepath.' not found.');
	}
	
	/**
	*	Replace keys
	*
	*	@throws Exception
	*	@return void
	*/	
	public function add(): void {
		if(file_exists($this->tempfilepath)) {
			$tmp = file_get_contents($this->tempfilepath);
			
			if(!empty($this->replace))
				foreach($this->replace as $key => $val)
					$tmp = str_replace('%'.$key.'%', $val, $tmp);		
		} else throw new \Exception('2 file '.$this->tempfilepath.' not found.');
		$this->tempfile .= $tmp;		
	}
	
	/**
	*	Output page
	*
	*	@return void
	*/	
	public function render(): void {
		echo $this->tempfile;
	}
	
	/**
	*	Include view-file
	*
	*	@param string $file
	*	@throws Exception
	*	@return void
	*/	
	public function incude(string $file): void {
		if(file_exists(ROOT.'engine/Resource/Views/'.$file.'.view.php')) {
			require_once(ROOT.'engine/Resource/Views/'.$file.'.view.php');
		} else throw new \Exception('3 file '.$this->tempfilepath.' not found.');
	}

	/**
	*	Buffering start	
	*
	*	@return void
	*/		
	public function obstart(): void {
		ob_start();
	}
	
	/**
	*	Buffering end	
	*
	*	@return void
	*/	
	public function obend(): void {
		ob_get_clean();
	}
	
	/**
	*	Clean vars
	*
	*	@return void
	*/	
	public function clean(): void {
		$this->replace = [];
		$this->tempfilepath = null;
		$this->tempfile = null;
	}
	
	/**
	*	Output some user-content to page
	*
	*	@param string $text
	*	@return void
	*/
	public function output(string $text): void {
		echo $text;
	}

	/**
	*	Set path of view-file
	*
	*	@param string $path
	*	@return void
	*/
	private function setPath(string $path): void {
		$this->tempfilepath = $this->getThemePath().$path;
	}
	
	/**
	*	Get path of theme
	*
	*	@return void
	*/	
	private function getThemePath(): string {
		return ROOT.'engine/Resource/Themes/Main/';
	}	
}
?>