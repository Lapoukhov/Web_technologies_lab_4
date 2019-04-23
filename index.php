<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Регулярные выражения</title>
	<link rel="stylesheet" href="styles.css">
</head>          
<body>
	<div>
		<?php				
			if (isset($_GET['input_text']))
			{
				$text = $_GET['input_text'];
				$text_arr = preg_split("/[\s,.?!;:()']+/", $text);
				$english_arr = array();
				$russian_arr = array();
				$digit_arr = array();
				for ($i = 0; $i < count($text_arr); $i++)
				{
					if (preg_match('/^[a-z-]+$/ui', $text_arr[$i]))
					{
						array_push($english_arr, $text_arr[$i]);
					}
					if (preg_match('/^[а-яё-]+$/ui', $text_arr[$i]))
					{
						array_push($russian_arr, $text_arr[$i]);
					}
					if (preg_match('/^[0-9]+$/', $text_arr[$i]))
					{
						array_push($digit_arr, $text_arr[$i]);
					}
				}
				
				echo "<b>Исходный текст: </b>" . $text;
				
				for ($i = 0; $i < count($english_arr); $i++)
				{
					$text = preg_replace('/\b' . $english_arr[$i] . '\b/u' , '<span style="color:#0000CC">' . $english_arr[$i] . '</span>', $text);
				}
				for ($i = 0; $i < count($russian_arr); $i++)
				{
					$text = preg_replace('/\b' . $russian_arr[$i] . '\b/u' , '<span style="color: red">' . $russian_arr[$i] . '</span>', $text);
				}
				for ($i = 0; $i < count($digit_arr); $i++)
				{
					$text = preg_replace('/\b' . $digit_arr[$i] . '\b/u' , '<span style="color:#00CC00">' . $digit_arr[$i] . '</span>', $text);
				}
				echo "<br/><br/><b>Преобразованный текст: </b>" . $text;
				
				
				echo '<br/><br/><b>Массив слов: </b><br/>';
				print_r ($text_arr);
				
				echo '<br/><br/><b><span style="color: #0000CC">Английские слова: </span></b><br/>';
				print_r ($english_arr);
				
				echo '<br/><br/><b><span style="color: red">Русские слова: </span></b><br/>';
				print_r ($russian_arr);
				
				echo '<br/><br/><b><span style="color: #00CC00">Числа: </span></b><br/>';
				print_r ($digit_arr);
				
			}
		?>
	</div>
	<h4>Введите текст</h4>
	<form method="GET">
		<textarea name="input_text" rows="10" cols="90" placeholder="Введите текст сообщения" required><?= (isset($_GET['input_text'])) ? strip_tags($_GET['input_text']) : '' ?></textarea>
		<div>
			<input type="submit" value="Отправить">
		</div>
	</form>
</body>
</html>