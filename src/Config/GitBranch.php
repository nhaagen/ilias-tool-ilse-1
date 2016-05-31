<?php
/* Copyright (c) 2016 Stefan Hecken <stefan.hecken@concepts-and-training.de>, Extended GPL, see LICENSE */

namespace CaT\InstILIAS\Config;

/**
 * Configuration for the git repo and branch name to get ILIAS from.
 *
 * @author Stefan Hecken <stefan.hecken@concepts-and-training.de>
 *
 * @method string gitUrl()
 * @method string gitBranchName()
 */
class GitBranch extends Base {
	/**
	 * @inheritdocs
	 */
	public static function fields() {
		return array
			( "git_url"			=> array("string", false)
			, "git_branch_name"	=> array("string", false)
			);
	}
}