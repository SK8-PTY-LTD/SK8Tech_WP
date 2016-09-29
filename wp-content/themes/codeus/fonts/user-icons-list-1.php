<?php
	$icons_array = array('e600', 'e601', 'e602', 'e603', 'e604', 'e605', 'e606', 'e607', 'e608', 'e609', 'e60a', 'e60b', 'e60c', 'e60d', 'e60e', 'e60f', 'e610', 'e611', 'e612', 'e613', 'e614');
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
			font-family: 'Codeus';
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
