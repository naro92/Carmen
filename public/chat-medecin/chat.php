<?php


require_once("./chat-class-function.php"); 
$db = db::getdb();
$getmedecinnom = $db->getdb()->getmedecinnom();
$pi = $db->getpatientID();
$getpatientnom = $db->getdb()->getpatientnom($pi);


?>


<html>
	<head>
		<title>Chat-medecin</title>
		<meta charset="utf-8" />
		<script src='./js/ajax4.0.js'></script>
		<script src='./js/jquery-1.6.js'></script>

		<style>
        h1 {
            position:absolute;
            top: 12%;
            left:23%;
        }
        
        #chat-box {
            overflow:auto;
            width: 900px;
            height: 450px;
            margin: 0 auto;
            background-color: #FFF;
            border: 2px solid #DDD;
			border-radius: 5px;
            padding: 0px;
            font-size: 25px;
            position: absolute;
            top: 20%;
            left: 23%;
        }
        
        #chat-input {
            width:600px;
            height: 60px;
            border: 1px solid #DDD;
            padding: 10px;
            position: absolute;
            bottom: 11%;
            left: 28%;
            font-size: 20px;
        }
        
        #chat-button {
            width: 100px;
            height: 40px;
            background-color: #C9E265;
            color: #FFF;
            border: none;
            padding: 10px;
            border-radius: 3px;
            position: absolute;
            bottom: 12.3%;
            left: 70%;
            right: 27%;
            font-size: 20px;
        }


		@media screen and (max-width: 1000px) {

			body {
                width: 100%;
                margin: 0 auto;
            }

			#chat-input {
            width:700px;
            height: 100px;
            border: 1px solid #DDD;
            padding: 10px;
            position: absolute;
            bottom: 15%;
            left: 15%;
            font-size: 30px;
        }

			#chat-button {
            width: 300px;
            height: 80px;
            background-color: #C9E265;
            color: #FFF;
            border: none;
            padding: 10px;
            border-radius: 8px;
            position: absolute;
            bottom: 8%;
            left: 35%;
            font-size: 40px;
        }

        #chat-box {
            overflow:auto;
            width: 800px;
            height: 1000px;
            margin: 0 auto;
            background-color: #FFF;
            border: 3px solid #DDD;
			border-radius: 5px;
            padding: 0px;
            font-size: 40px;
            position: absolute;
            top: 15%;
            left: 10%;
        }

		h1 {
            position:absolute;
            top: 10%;
            left:15%;
        }

		}
    </style>

		<script>
			var $user=null,say=null;

			 
			function envoyer(){    //提交按钮  Submit button

				//$username = "x";

				$user = '<?php echo $getmedecinnom;?>';
				console.log($user); 

				$say = $("input[name='say']").val();  //获取消息 Récupère le message

					if($say!=''){ //如果用户名，消息不为空 Si le nom d'utilisateur, le message n'est pas vide
						Ajax().get('chat-insert.php?patientID=<?php echo $patientID; ?>&user='+$user+'&say='+$say);
						$("input[name='say']").val('');//清空表单Vide le formulaire
					}
			}

			function myrefresh(){   //这个函数使用 Ajax() 函数从后端获取数据，然后使用 putinfo 函数更新页面。
			//Cette fonction utilise la fonction Ajax() pour récupérer des données depuis le back-end et utilise ensuite la fonction putinfo pour mettre à jour la page.
			Ajax().get('chat-getlist.php?patientID=<?php echo $patientID; ?>&user=<?php echo db::getmedecinnom(); ?>',putinfo);
			}	

			function putinfo(data){  //这个函数使用从后端接收到的数据更新页面中的元素。Cette fonction met à jour les éléments de la page à l'aide des données reçues du back-end.
			$("#chat-box").html(data);
			document.getElementById('chat-box').scrollTop += 5000;
			}

			function keyup(e){  //按下entre时同样可以发送消息Les messages peuvent aussi être envoyés lorsque tu appuies sur la touche Entre
			if(e.keyCode==13)envoyer();
			}

			setInterval('myrefresh()',100); //周期性刷新页面Rafraîchissements périodiques des pages
		</script>

	</head>
	<body>

		<h1 ><?php echo "Famille de $getpatientnom";?></h1>
		<!-- 聊天框 Chat Box-->
		<div id='chat-box'></div> 

 		<!-- 输入栏 Champ de saisie-->
		<input id="chat-input" type='text' name='say' onkeypress="keyup(event)" />


		<input id="chat-button"type='button' value='Envoyer' onclick="envoyer()" />       
 


	</body>
</html>