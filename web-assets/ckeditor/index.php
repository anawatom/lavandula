<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta name="keywords" content="math,science" />
		<link rel="stylesheet" type="text/css" href="demo_style.css" />
		<script type="text/javascript" src="./ckeditor4/plugins/ckeditor_wiris/core/display.js"></script>
		<!-- <script type="text/javascript" src="./ckeditor4/plugins/ckeditor_wiris/integration/WIRISplugins.js?viewer=image"></script> -->
		<script type="text/javascript" src="./ckeditor4/ckeditor.js"></script>
		<title>CKEditor 4 WIRIS integration on PHP | Educational mathematics</title>

		<script type="text/javascript">
			// Retrieve language from either URL or POST parameters
			function getParameter(name,dflt) {
				var value = new RegExp(name+"=([^&]*)","i").exec(window.location);
				if (value!=null && value.length>1) return decodeURIComponent(value[1].replace(/\+/g,' ')); else return dflt;
			}
		    var lang = getParameter("language","<?php $temp = &$_POST["language"]; echo isset($temp)?$temp:""; ?>");
			if (lang.length==0) lang="en";
		</script>
		
		<style>
			#iconsDiv {display:inline-block;}
			#langFormDiv { display:inline-block; margin-left:640px;}
		</style>
		<!--[if IE]><style>#langFormDiv { margin-left:640px; }</style><![endif]-->
		<!--[if lt IE 9]><style>#langFormDiv { margin-left:645px; }</style><![endif]-->
		<!--[if lt IE 8]><style>#iconsDiv {display:inline;zoom:1; margin-bottom:-20px;} #langFormDiv { display:inline; zoom:1; margin-bottom:-20px;}</style><![endif]-->		
		
	</head>

	<body>
		<h1>CKEditor 4 WIRIS integration on PHP</h1>
		
		<div id="languages">Try it with different technologies:</div><br/>
		
		<ul id="buttons">
			<li><a class="button" href="http://www.wiris.com/plugins/editors/download?filter=ckeditor">Download plugin</a></li>
			<li><a class="button" href="http://www.wiris.com/plugins/docs/demo-download?filter=ckeditor">Download this demo</a></li>
			<li><a class="button" href="http://www.wiris.com/plugins/docs/ckeditor">Documentation</a></li>
			<li><a href="http://www.wiris.com/plugins/demo/ckeditor/php"><img class="tech" src="http://www.wiris.com/themes/wiris_com/plugins/php_45.png" title="PHP Demo" /></a></li>
            <li><a href="http://www.wiris.com/plugins/demo/ckeditor/aspx"><img class="tech" src="http://www.wiris.com/themes/wiris_com/plugins/aspnet_45.png" title="ASPX Demo" /></a></li>
           	<li><a href="http://www.wiris.com/plugins/demo/ckeditor/java"><img class="tech" src="http://www.wiris.com/themes/wiris_com/plugins/java_45.png" title="Java Demo" /></a></li>
		</ul>

		<form id="form" name="langForm" method="POST">
			<h2>New icons in the editor</h2>
			<div id="iconsDiv">		
				<ul id="icons">
					<li><img src="ckeditor4/plugins/ckeditor_wiris/core/icons/formula.gif" /> WIRIS editor</li>
					<li><img src="ckeditor4/plugins/ckeditor_wiris/core/icons/cas.gif" /> WIRIS cas</li>
				</ul>
			</div>
			<div id="langFormDiv">
				<select id="language" name="language" onchange="this.form.submit()">
					<option value="ar">Arabic</option><option value="eu">Basque</option><option value="ca">Catalan</option>
					<option value="zh-tw">Chinese</option><option value="hr">Croatian</option><option value="cs">Czech</option>
					<option value="da">Danish</option><option value="nl">Dutch</option><option value="en" selected="true">English</option>
					<option value="et">Estonian</option><option value="fi">Finnish</option><option value="fr">French</option>
					<option value="gl">Galician</option><option value="de">German</option><option value="he">Hebrew</option>
					<option value="hu">Hungarian</option><option value="it">Italian</option><option value="ja">Japanese</option>
					<option value="ko">Korean</option><option value="no">Norwegian</option><option value="pl">Polish</option>
					<option value="pt">Portuguese</option><option value="ru">Russian</option><option value="es">Spanish</option>
					<option value="sv">Swedish</option><option value="tr">Turkish</option>				
				</select>
				<script>
					// Select the option using the "lang" variable
					if (lang.length>0) {
						sel = document.getElementById("language");
						for (i=0;i<sel.length;i++) {
							if (sel.options[i].value==lang) {
								sel.selectedIndex=i;
								break;
							}
						}
					}
				</script>
			</div>
			<br />
			
			<div id="exampleContent" style="display: none">
				<h1>WIRIS works in <em>inline</em> mode</h1>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

				<p style="text-align: center;"><math xmlns="http://www.w3.org/1998/Math/MathML"><mi>x</mi><mo>=</mo><mfrac><mrow><mo>-</mo><mi>b</mi><mo>&plusmn;</mo><msqrt><msup><mi>b</mi><mn>2</mn></msup><mo>-</mo><mn>4</mn><mi>a</mi><mi>c</mi></msqrt></mrow><mrow><mn>2</mn><mi>a</mi></mrow></mfrac></math></p>

				<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur <math xmlns="http://www.w3.org/1998/Math/MathML"><msup><mi>x</mi><mn>2</mn></msup><mo>+</mo><mn>5</mn><mi>x</mi><mo>-</mo><mn>2</mn><mo>=</mo><mn>0</mn></math> sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
			</div>
			
			<div id="example" style="border: 1px solid #666; width: 850px; padding: 10px;" contenteditable="true">
				<?php $temp = &$_POST["content"]; echo isset($temp)?$temp:""; ?>
			</div>
			
			
			<input id="hiddenContent" type="hidden" name="content" />
			<input id="previewButton" type="submit" value="Preview"/>
			<script type="text/javascript">
				var exampleContainer = document.getElementById('example');
				
				if (exampleContainer.innerHTML.trim().length == 0) {
					exampleContainer.innerHTML = document.getElementById('exampleContent').innerHTML;
				}
			
				CKEDITOR.config.toolbar_Full =
				[
					{ name: 'document', items : [ 'Source'] },
					{ name: 'clipboard', items : [ 'Cut','Copy','Paste','-','Undo','Redo' ] },
					{ name: 'editing', items : [ 'Find'] },
					{ name: 'basicstyles', items : [ 'Bold','Italic','Underline'] },
					{ name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight'] }
				];			
			
				CKEDITOR.inline('example', {
					language: lang,
					toolbar:'Full'
					//wirisimagecolor:'#000000',
					//wirisbackgroundcolor:'#ffffff',
					//wirisimagefontsize:'16px'					
				});
				
				form.onsubmit = function () {
					document.getElementById('hiddenContent').value = CKEDITOR.instances.example.getData();
				}
			</script>
		</form>
		
		<h2>Preview</h2>
		
		<div id="previewBox"><?php $temp = &$_POST["content"]; echo isset($temp)?$temp:""; ?></div>
		
		
		<div id="logo">
			<a href="http://www.wiris.com"><img src="http://www.wiris.com/en/system/files/attachments/889/wiris_50.png" title="WIRIS" /></a>
		</div>

		<script type="text/javascript">
			// Set initial text and directionality for the preview panel
			var content = document.getElementById('previewBox').innerHTML;
			if (content.length==0) {
				document.getElementById('previewBox').innerHTML = '<span id="previewMessage">Press the "Preview" button.</span>'
			}
			if (content.length>0 && (lang == 'ar' || lang == 'he')) {
				var prevBox = document.getElementById('previewBox');
				prevBox.setAttribute('dir', 'rtl');
			}			
		</script>	

		<script src="google_analytics.js"></script>
		<script>
			var js = document.createElement("script");
			js.type = "text/javascript";
			js.src = "./ckeditor4/plugins/ckeditor_wiris/integration/WIRISplugins.js?viewer=image";
			document.head.appendChild(js);
		</script>
	</body>
</html>
