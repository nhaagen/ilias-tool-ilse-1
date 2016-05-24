<?php
namespace CaT\InstILIAS;
/**
 * checks requirements for ILIAS installation
 *
 * @author Stefan Hecken <stefan.hecken@concepts-and-training.de>
 */
class IliasRequirementChecker implements \CaT\InstILIAS\interfaces\RequirementChecker {
	/**
	 * @inheritdocs
	 */
	public function dataDirectoryExists($path) {
		return is_dir($path);
	}

	/**
	 * @inheritdocs
	 */
	public function dataDirectoryPermissions($path) {
		return is_writable($path);
	}

	/**
	 * @inheritdocs
	 */
	public function validPHPVersion($required) {
		assert('is_string($required)');
		return phpversion() >= $required;
	}

	/**
	 * @inheritdocs
	 */
	public function mysqliExist() {
		return class_exists("mysqli");
	}

	/**
	 * @inheritdocs
	 */
	public function databaseConnectable($host, $user, $passwd) {
		$mysqli = new \mysqli($host, $user, $passwd);

		if ($mysqli->connect_error) {
			return false;
		}

		return true;
	}

	/**
	 * @inheritdocs
	 */
	public function logDirectoryExists($path) {
		return is_dir($path);
	}

	/**
	 * @inheritdocs
	 */
	public function logFileExists($path, $file_name) {
		file_exists($path."/".$file_name);
	}
}