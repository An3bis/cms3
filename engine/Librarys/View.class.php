<?php
namespace Engine\Librarys;

/**
*	View class for templates
*/
class View {
	
	
	public function checkBufferStatus() {
		if(ini_get('output_buffering') < 250)
			throw new \Exception('Minimal value of output_buffering must be 250.');
	}
}