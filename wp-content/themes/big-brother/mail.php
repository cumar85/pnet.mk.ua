<?php
/*
Template Name: Mail
*/
?>



<? 
define("ADRESS", "pnet@mail.ru");
//define("ADRESS", "cumar@mail.ru");
//define("ADRESS", "nikpnet@ukr.net");

include('ErrorCounter.php');

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//include('library\Utils.php');


function checkFormData($formData, $errObj)
{
	$name = $formData['name'];
	$email = $formData['email'];
	$sub = $formData['sub'];
	$body = $formData['body'];
	
	if (empty($name))  {
		$errObj->add('name','Ви забули вказати своє ім\'я');
	} elseif (!preg_match("/^.{3,15}$/",$name)) {
		$errObj->add('name','Неправильно вказано ім\'я');
	}
	
	if (empty($email))  {
		$errObj->add('email','Ви не вказали вашу електронну адресу');
	} elseif (!preg_match("|([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})|is",$email)) {
		$errObj->add('email','Неправильна адреса електронної пошти'); 
	}
	
	if (empty($sub))  {
		$errObj->add('sub','Ви не вказали тему повідомлення');
	} 
	
	if (empty($body))  {
		$errObj->add('body','Повідомлення не повинно бути порожнім');
	}
	
	return $errObj;
}

function mailSand($formData, $errObj)
{
	$name = $formData['name'];
	$email = $formData['email'];
	$sub = $formData['sub'];
	$body = $formData['body'];
	$mes = "Имя: $name \nE-mail: $email \nТема: $sub \nТекст: $body";
	$send = mail (ADRESS, $sub, $mes, "Content-type:text/plain; charset = UTF-8\r\nFrom:$email");
	if(!$send) {
		$errObj->add('sendErr','Помилка повідомлення не відправлено!');
	}	
	return $errObj;
}


?>



				
<?php 
$sucsess = false;
$errObj = new ErrorCounter();
if ($_POST) {
	$postArr = array();
	$postArr = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
	$formData = $postArr['formData'];
	$errObj = checkFormData($formData, $errObj);
	
	if ($errObj->check()){
		$errObj = mailSand($formData, $errObj); 
	} 
	
	if ($errObj->check()){
		$sucsess = true;
	}	
} 
			
?>
				
				
				
	<?php get_header(); ?>			
				
	<?php if( function_exists( 'big_brother_the_breadcrumbs' ) ) : ?>
		<div class="breadcrumbs">
			<?php big_brother_the_breadcrumbs(); ?>
		</div>
	<?php endif; ?>
	
	<div class="content-area primary">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<div class="article-wrapper">
				
				    <? if($sucsess): ?>
					    <div>
							<h3>Ваше повідомлення надіслано. 
							Через 3 секунди ви будете автоматично переадресувати на головну сторінку.</h3>
						</div>
						<script>
							onload = function () {setTimeout ("document.location = '<?php bloginfo('url');?>';", 3 * 1000)}
						</script>
				    <? else: ?>
				
					
						<?php //get_template_part( 'content', 'page' ); ?>
						<h2 style="text-align:left">Форма зворотнього зв’язку</h2>
						<form action="<?php bloginfo('url');?>/forma-zvorotnogo-zvyazku/" method="post" id="mailForm" name="mailForm">
							<div style="text-align:left"><input type="hidden" name="submit-form" value="true"></div>
							
							<div style="text-align:left">
								<input class="input" style="width: 30%;" name="formData[name]" type="text" 
								<? if (!empty($formData['name'])):?> value="<?=$formData['name']?>" <? endif; ?>  /> 
								 
								<? if($errObj->getMsg('name')): ?>
									<span class="error"> <?=$errObj->getMsg('name');?> </span>
								<? else: ?>
									<span > Ваше ім'я </span>
								<? endif; ?>
							</div>
							
							<div style="text-align:left">
								<input class="input" style="width: 30%;" name="formData[email]" type="text" 
								<? if (!empty($formData['email'])):?> value="<?=$formData['email']?>" <? endif; ?>  /> 
								
								<? if($errObj->getMsg('email')): ?>
									<span class="error"> <?=$errObj->getMsg('email');?> </span>
								<? else: ?>
									<span> Електронна пошта </span>
								<? endif; ?>
							</div>
							
							<div style="text-align:left">
								<input class="input" style="width: 30%;" name="formData[sub]" type="text" 
								<? if (!empty($formData['sub'])):?> value="<?=$formData['sub']?>" <? endif; ?>  /> 
								
								
								<? if($errObj->getMsg('sub')): ?>
									<span class="error"> <?=$errObj->getMsg('sub');?> </span>
								<? else: ?>
									<span> Тема повідомлення </span>
								<? endif; ?>
								
							</div>	
							<div style="text-align:left"> 
								
								<? if($errObj->getMsg('body')): ?>
									<span class="error"> <?=$errObj->getMsg('body');?> </span>
								<? else: ?>
									<span> Текст повідомлення: </span>
								<? endif; ?>
								<textarea style="width: 98%;" cols="1" name="formData[body]" rows="5"><?if(!empty($formData['body'])):?><?=$formData['body']?><?endif;?></textarea> 
							</div>	
							
							
							<div style="text-align:left"><input  type="submit" value="Надiслати" /> </div>
						</form>
					
					
					<? endif; ?>
					
				</div>
				

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>