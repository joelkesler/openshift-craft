<?php
namespace Craft;

/**
 * Craft by Pixel & Tonic
 *
 * @package   Craft
 * @author    Pixel & Tonic, Inc.
 * @copyright Copyright (c) 2013, Pixel & Tonic, Inc.
 * @license   http://buildwithcraft.com/license Craft License Agreement
 * @link      http://buildwithcraft.com
 */

/**
 *
 */
class Namespace_Node extends \Twig_Node
{
	/**
	 * Compiles a Namespace_Node into PHP.
	 */
	public function compile(\Twig_Compiler $compiler)
	{
		$compiler
			->addDebugInfo($this)
			->write('$_namespace = ')
			->subcompile($this->getNode('namespace'))
			->raw(";\n")
			->write("if (\$_namespace) {\n")
			->indent()
				->write("\$_originalNamespace = \Craft\craft()->templates->getNamespace();\n")
				->write("\Craft\craft()->templates->setNamespace(\Craft\craft()->templates->namespaceInputName(\$_namespace));\n")
				->write("ob_start();\n")
				->write("try {\n")
				->indent()
					->subcompile($this->getNode('body'))
				->outdent()
				->write("} catch (Exception \$e) {\n")
	            ->indent()
	            	->write("ob_end_clean();\n\n")
	            	->write("throw \$e;\n")
	            ->outdent()
	            ->write("}\n")
	            ->write("echo \Craft\craft()->templates->namespaceInputs(ob_get_clean(), \$_namespace);\n")
				->write("\Craft\craft()->templates->setNamespace(\$_originalNamespace);\n")
			->outdent()
			->write("} else {\n")
			->indent()
				->subcompile($this->getNode('body'))
			->outdent()
			->write("}\n")
			->write("unset(\$_originalNamespace, \$_namespace);\n");
	}
}
