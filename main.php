<?php
	$className = ucfirst($_POST['className']);
	$superclass = ucfirst($_POST['superClass']);
	$interface = ucfirst($_POST['classInterface']);
	$classAttributes = $_POST['classAttributes'];
	$isAbstract = $_POST['isAbstract'];

	$classCode = "";
	if($isAbstract == 1) { $classCode .= "abstract "; }
	$classCode .= "\nclass ".$className." ";

	if ($superclass !== "") { $classCode .= "extends ".$superclass." "; }
	if ($interface !== "") { $classCode .= "implements ".$interface." "; }
	$classCode .= "{\n";

	$classCode .= "\n\t/* Attributes */ \n\n";

	$length = count($classAttributes);

	for ($i = 0; $i < $length; $i++) { $classCode .= "\tprotected $".$classAttributes[$i].";\n"; }

	$classCode .= "\n\t/* Getters */ \n\n";

	for ($i = 0; $i < $length; $i++) {
		$classCode .= "\tpublic function get".ucfirst($classAttributes[$i])."() {\n\t\treturn $"."this->".$classAttributes[$i].";\n\t}\n";
	}

	$classCode .= "\n\t/* Setters */ \n\n";

	for ($i = 0; $i < $length; $i++) {
		$classCode .= "\tpublic function set".ucfirst($classAttributes[$i])."($".$classAttributes[$i].") {\n\t\t$"."this->".$classAttributes[$i]." = $".$classAttributes[$i].";\n\t}\n";
	}

	$classCode .= "\n\t/* Constructor */ \n\n";

	$arguments = "";

	for ($i = 0; $i < $length; $i++) {
		if ($i != $length - 1) { $arguments .= "$".$classAttributes[$i].", "; }
		else { $arguments .= "$".$classAttributes[$i]; }
	}

	$constructorContent = "";

	for ($i = 0; $i < $length; $i++) {
		$constructorContent .= "\t\t$"."this->".$classAttributes[$i]." = $".$classAttributes[$i].";\n";
	}

	$classCode .= "\tpublic function __construct(".$arguments.") {\n".$constructorContent."\t}\n}";
	$classCode .= "\n\n";


	$fileName = $className.".php";
	$file = fopen("php-classes/".$fileName,"a");

  fwrite($file, $classCode);
	fclose($file);
	echo $classCode;


?>
