<?php
	$icons_array = array('e600', 'e601', 'e602', 'e603', 'e604', 'e605', 'e606', 'e607', 'e608', 'e609', 'e60a', 'e60b', 'e60c', 'e60d', 'e60e', 'e60f', 'e610', 'e611', 'e612', 'e613', 'e614', 'e615', 'e616', 'e617', 'e618', 'e619', 'e61a', 'e61b', 'e61c', 'e61d', 'e61e', 'e61f', 'e620', 'e621', 'e622', 'e623', 'e624', 'e625', 'e626', 'e627', 'e628', 'e629', 'e62a', 'e62b', 'e62c', 'e62d', 'e62e', 'e62f', 'e630', 'e631', 'e632', 'e633', 'e634', 'e635', 'e636', 'e637', 'e638', 'e639', 'e63a', 'e63b', 'e63c', 'e63d', 'e63e', 'e63f', 'e640', 'e641', 'e642', 'e643', 'e644', 'e645', 'e646', 'e647', 'e648', 'e649', 'e64a', 'e64b', 'e64c', 'e64d', 'e64e', 'e64f', 'e650', 'e651', 'e652', 'e653', 'e654', 'e655', 'e656', 'e657', 'e658', 'e659', 'e65a', 'e65b', 'e65c', 'e65d', 'e65e', 'e65f', 'e660', 'e661', 'e662', 'e664', 'e665', 'e666', 'e667', 'e668', 'e669', 'e66a', 'e66b', 'e66c', 'e66d', 'e66e', 'e66f', 'e670', 'e671', 'e672', 'e673', 'e674', 'e675', 'e676', 'e677', 'e678', 'e679', 'e67a', 'e67b', 'e67c', 'e67d', 'e67e', 'e67f', 'e680', 'e681', 'e682', 'e683', 'e684', 'e685', 'e686', 'e687', 'e688', 'e689', 'e68a', 'e68b', 'e68c', 'e68d', 'e68e', 'e68f', 'e690', 'e691', 'e692', 'e693', 'e694', 'e695', 'e696', 'e697', 'e698', 'e699', 'e69a', 'e69b', 'e69c', 'e69d', 'e69e', 'e69f', 'e6a0', 'e6a1', 'e6a2', 'e6a3', 'e6a4', 'e6a5', 'e6a6', 'e6a7', 'e6a8', 'e6a9', 'e6aa', 'e6ab', 'e6ac', 'e6ad', 'e6ae', 'e6af', 'e6b0', 'e6b1', 'e6b2', 'e6b3', 'e6b4', 'e6b5', 'e6b6', 'e6b7', 'e6b8', 'e6b9', 'e6ba', 'e6bb', 'e6bc', 'e6bd', 'e6be', 'e6bf', 'e663', 'e6c0', 'e6c1', 'e6c2', 'e6c3', 'e6c4', 'e6c5', 'e6c6', 'e6c7');
?>
<html>
<head>
<title></title>
	<link rel="stylesheet" type="text/css" href="icons.css" media="all" />
	<style type="text/css">
		/* RESET CSS */
		html, body, div, span, applet, object, iframe,
		h1, h2, h3, h4, h5, h6, p, blockquote, pre,
		a, abbr, acronym, address, big, cite, code,
		del, dfn, em, img, ins, kbd, q, s, samp,
		small, strike, strong, sub, sup, tt, var,
		b, u, i, center,
		dl, dt, dd, ol, ul, li,
		fieldset, form, label, legend,
		table, caption, tbody, tfoot, thead, tr, th, td,
		article, aside, canvas, details, embed,
		figure, figcaption, footer, header, hgroup,
		menu, nav, output, ruby, section, summary,
		time, mark, audio, video {
			margin: 0;
			padding: 0;
			border: 0;
			font-size: 100%;
			outline:none;
			font-famiy: Arial;
		}
		article, aside, details, figcaption, figure,
		footer, header, hgroup, menu, nav, section {
			display: block;
		}
		body {
			line-height: 1;
		}
		ol, ul {
			list-style: none;
		}
		blockquote, q {
			quotes: none;
		}
		blockquote:before, blockquote:after,q:before, q:after {
			content: '';
			content: none;
		}
		table {
			border-collapse: collapse;
			border-spacing: 0;
		}

		body {
			background-color: #f0f4f7;
			color: #566270;
		}

		ul.icons-list  {
			padding: 20px;
		}

		.icons-list li {
			float: left;
			padding: 20px 22px;
			list-style-type: none;
			border-bottom: 1px solid #d6dde3;
		}
		.icon {
			display: block;
			width: 50px;
			height: 50px;
			line-height: 50px;
			vertical-align: top;
			font-size: 24px;
			font-family: 'Codeus-Icons';
			border-radius: 25px;
			-moz-border-radius: 25px;
			-webkit-border-radius: 25px;
			text-align: center;
			background: #ffffff;
			color: #566270;
			font-weight: normal;
			margin-bottom: 5px;
		}
		.code {
			display: block;
			text-align: center;
		}
	</style>
</head>
<body>
	<ul class="icons-list styled">
		<?php foreach($icons_array as $icon) : ?>
			<li>
				<span class="icon cufon">&#x<?php echo $icon; ?>;</span>
				<span class="code"><?php echo $icon; ?></span>
			</li>
		<?php endforeach; ?>
	</ul>
</body>
</html>
