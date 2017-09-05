<?php
/* Copyright (c) 2017 Daniel Weise <daniel.weise@concepts-and-training.de>, Extended GPL, see LICENSE */

namespace CaT\Ilse\App\Command;

use Symfony\Component\Console\Command\Command;
use Pimple\Container;

/**
 * Base class for all commands
 */
abstract class BaseCommand extends Command
{
	/**
	 * @var Container
	 */
	protected $dic;

	public function __construct(Container $dic)
	{
		parent::__construct();
		$this->dic = $dic;
	}

	/**
	 * Match subdirectory
	 *
	 * @param string 	$name
	 */
	protected function searchSubDir($name)
	{
		foreach ($this->repos as $repo)
		{
			$hash = md5($repo);
			$dir = $this->path->getHomeDir() . "/" . App::I_P_GLOBAL_CONFIG . "/" . $hash . "/" . basename($repo, '.git') . "/" . $name;

			if(is_dir($dir))
			{
				return $dir . "/" . App::I_F_CONFIG;
			}
		}
	}

	/**
	 * Merge all given configs
	 *
	 * @param string[]
	 */
	protected function merge(array $configs)
	{
		$arr = array_map(function ($s) {
			if(preg_match("/[a-zA-Z0-9_\/]+\.y[a]?ml/", $s))
			{
				return $s;
			}
			return $this->searchSubDir($s);
		}, $configs);

		return $this->merger->mergeConfigs($arr);
	}
}
