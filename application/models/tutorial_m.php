<?php class tutorial_m extends CI_model
{
	function compiler_m()
	{
		if($_POST['type'] == "C++")
		{
			$code = $_POST['code'];
			putenv("PATH=C:\Application\Dev-Cpp\MinGW64\bin");
			$CC="g++";
			$out="a.exe";
			$code=$_POST["code"];
			$filename_code="main.cpp";
			$filename_in="input.txt";
			$filename_error="error.txt";
			$executable="a.exe";
			$command=$CC." -lm ".$filename_code;	
			$command_error=$command." 2>".$filename_error;
		
			//if(trim($code)=="")
			//die("The code area is empty");
			
			$file_code=fopen($filename_code,"w+");
			fwrite($file_code,$code);
			fclose($file_code);
			$file_in=fopen($filename_in,"w+");
			fwrite($file_in,$input);
			fclose($file_in);
			exec("cacls  $executable /g everyone:f"); 
			exec("cacls  $filename_error /g everyone:f");	
		
			shell_exec($command_error);
			$error=file_get_contents($filename_error);
		
			if(trim($error)=="")
			{
				if(trim($input)=="")
				{
					$output=shell_exec($out);
				}
				else
				{
					$out=$out." < ".$filename_in;
					$output=shell_exec($out);
				}
				//echo "<pre>$output</pre>";
				$editorCode = $output;
				write_file('C:\xampp\htdocs\WebTA\asset\code\code-editable.php', $editorCode);
		   	          //echo "<textarea id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">$output</textarea><br><br>";
			}
			else if(!strpos($error,"error"))
			{
				echo "<pre>$error</pre>";
				if(trim($input)=="")
				{
					$output=shell_exec($out);
				}
				else
				{
					$out=$out." < ".$filename_in;
					$output=shell_exec($out);
				}
				$editorCode = $output;
				write_file('C:\xampp\htdocs\WebTA\asset\code\code-editable.php', $editorCode);
				//echo "<textarea id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">$output</textarea><br><br>";
			}
			else
			{
				echo "<pre>$error</pre>";
			}
			exec("del $filename_code");
			exec("del *.o");
			exec("del *.txt");
			exec("del $executable");
		}
		elseif($_POST['type'] == "PHP")
		{
			$editorCode = $_POST['code'];
			write_file('C:\xampp\htdocs\WebTA\asset\code\code-editable.php', $editorCode);
		}
	}
}
?>