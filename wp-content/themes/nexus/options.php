<?php

/*--------------------------------*/
/* Nexus Options Page Started */
/*--------------------------------*/

function optionsframework_option_name() {
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}



/*--------------------------------*/
/* Google Fonts Array */
/*--------------------------------*/
function optionsframework_options() {
	$fonts_array = array(
		'ABeeZee' => __('Abeezee', 'options_framework_theme'),
		'Abel' => __('Abel', 'options_framework_theme'),	
		'Abril+Fatface' => __('Abril Fatface', 'options_framework_theme'),	
		'Aclonica' => __('Aclonica', 'options_framework_theme'),	
		'Actor' => __('Actor', 'options_framework_theme'),	
		'Adamina' => __('Adamina', 'options_framework_theme'),	
		'Aguafina+Script' => __('Aguafina Script', 'options_framework_theme'),	
		'Aladin' => __('Aladin', 'options_framework_theme'),	
		'Aldrich' => __('Aldrich', 'options_framework_theme'),	
		'Alice' => __('Alice', 'options_framework_theme'),	
		'Alike+Angular' => __('Alike Angular', 'options_framework_theme'),	
		'Alike' => __('Alike', 'options_framework_theme'),	
		'Allan' => __('Allan', 'options_framework_theme'),	
		'Allerta+Stencil' => __('Allerta Stencil', 'options_framework_theme'),	
		'Allerta' => __('Allerta', 'options_framework_theme'),	
		'Amaranth' => __('Amaranth', 'options_framework_theme'),	
		'Amatic+SC' => __('Amatic SC', 'options_framework_theme'),	
		'Andada' => __('Andada', 'options_framework_theme'),	
		'Andika' => __('Andika', 'options_framework_theme'),	
		'Annie+Use+Your+Telescope' => __('Annie Use Your Telescope', 'options_framework_theme'),	
		'Anonymous+Pro' => __('Anonymous Pro', 'options_framework_theme'),	
		'Antic' => __('Antic', 'options_framework_theme'),	
		'Anton' => __('Anton', 'options_framework_theme'),	
		'Arapey' => __('Arapey', 'options_framework_theme'),	
		'Architects+Daughter' => __('Architects Daughter', 'options_framework_theme'),	
		'Arimo' => __('Arimo', 'options_framework_theme'),	
		'Artifika' => __('Artifika', 'options_framework_theme'),	
		'Arvo' => __('Arvo', 'options_framework_theme'),	
		'Asset' => __('Asset', 'options_framework_theme'),	
		'Astloch' => __('Astloch', 'options_framework_theme'),	
		'Atomic+Age' => __('Atomic Age', 'options_framework_theme'),	
		'Aubrey' => __('Aubrey', 'options_framework_theme'),	
		'Bangers' => __('Bangers', 'options_framework_theme'),	
		'Bentham' => __('Bentham', 'options_framework_theme'),	
		'Bevan' => __('Bevan', 'options_framework_theme'),	
		'Bigshot+One' => __('Bigshot One', 'options_framework_theme'),	
		'Bitter' => __('Bitter', 'options_framework_theme'),	
		'Black+Ops+One' => __('Black Ops One', 'options_framework_theme'),	
		'Bowlby+One+SC' => __('Bowlby One SC', 'options_framework_theme'),	
		'Bowlby+One' => __('Bowlby One', 'options_framework_theme'),	
		'Brawler' => __('Brawler', 'options_framework_theme'),	
		'Bubblegum+Sans' => __('Bubblegum Sans', 'options_framework_theme'),	
		'Buda' => __('Buda', 'options_framework_theme'),	
		'Butcherman+Caps' => __('Butcherman Caps', 'options_framework_theme'),	
		'Cabin+Condensed' => __('Cabin Condensed', 'options_framework_theme'),	
		'Cabin+Sketch' => __('Cabin Sketch', 'options_framework_theme'),	
		'Cabin' => __('Cabin', 'options_framework_theme'),	
		'Cagliostro' => __('Cagliostro', 'options_framework_theme'),	
		'Calligraffitti' => __('Calligraffitti', 'options_framework_theme'),
		'Candal' => __('Candal', 'options_framework_theme'),	
		'Cantarell' => __('Cantarell', 'options_framework_theme'),	
		'Cardo' => __('Cardo', 'options_framework_theme'),	
		'Carme' => __('Carme', 'options_framework_theme'),	
		'Carter+One' => __('Carter One', 'options_framework_theme'),	
		'Caudex' => __('Caudex', 'options_framework_theme'),	
		'Cedarville+Cursive' => __('Cedarville Cursive', 'options_framework_theme'),	
		'Changa+One' => __('Changa One', 'options_framework_theme'),	
		'Cherry+Cream+Soda' => __('Cherry Cream Soda', 'options_framework_theme'),	
		'Chewy' => __('Chewy', 'options_framework_theme'),	
		'Chicle' => __('Chicle', 'options_framework_theme'),	
		'Chivo' => __('Chivo', 'options_framework_theme'),	
		'Coda+Caption' => __('Coda Caption', 'options_framework_theme'),	
		'Coda' => __('Coda', 'options_framework_theme'),	
		'Comfortaa' => __('Comfortaa', 'options_framework_theme'),	
		'Coming+Soon' => __('Coming Soon', 'options_framework_theme'),	
		'Contrail+One' => __('Contrail One', 'options_framework_theme'),	
		'Convergence' => __('Convergence', 'options_framework_theme'),	
		'Cookie' => __('Cookie', 'options_framework_theme'),	
		'Copse' => __('Copse', 'options_framework_theme'),	
		'Corben' => __('Corben', 'options_framework_theme'),	
		'Cousine' => __('Cousine', 'options_framework_theme'),	
		'Coustard' => __('Coustard', 'options_framework_theme'),	
		'Covered+By+Your+Grace' => __('Covered By Your Grace', 'options_framework_theme'),
		'Crafty+Girls' => __('Crafty Girls', 'options_framework_theme'),	
		'Creepster+Caps' => __('Creepster Caps', 'options_framework_theme'),	
		'Crimson+Text' => __('Crimson Text', 'options_framework_theme'),	
		'Crushed' => __('Crushed', 'options_framework_theme'),	
		'Cuprum' => __('Cuprum', 'options_framework_theme'),	
		'Damion' => __('Damion', 'options_framework_theme'),	
		'Dancing+Script' => __('Dancing Script', 'options_framework_theme'),	
		'Dawning+of+a+New+Day' => __('Dawning of a New Day', 'options_framework_theme'),	
		'Days+One' => __('Days One', 'options_framework_theme'),	
		'Delius+Swash+Caps' => __('Delius Swash Caps', 'options_framework_theme'),	
		'Delius+Unicase' => __('Delius Unicase', 'options_framework_theme'),	
		'Delius' => __('Delius', 'options_framework_theme'),	
		'Devonshire' => __('Devonshire', 'options_framework_theme'),	
		'Didact+Gothic' => __('Didact Gothic', 'options_framework_theme'),	
		'Dorsa' => __('Dorsa', 'options_framework_theme'),	
		'Dr+Sugiyama' => __('Dr Sugiyama', 'options_framework_theme'),	
		'Droid+Sans+Mono' => __('Droid Sans Mono', 'options_framework_theme'),	
		'Droid+Sans' => __('Droid Sans', 'options_framework_theme'),	
		'Droid+Serif' => __('Droid Serif', 'options_framework_theme'),	
		'EB+Garamond' => __('EB Garamond', 'options_framework_theme'),	
		'Eater+Caps' => __('Eater Caps', 'options_framework_theme'),	
		'Expletus+Sans' => __('Expletus Sans', 'options_framework_theme'),	
		'Fanwood+Text' => __('Fanwood Text', 'options_framework_theme'),	
		'Federant' => __('Federant', 'options_framework_theme'),
		'Federo' => __('Federo', 'options_framework_theme'),	
		'Fjord+One' => __('Fjord One', 'options_framework_theme'),	
		'Fondamento' => __('Fondamento', 'options_framework_theme'),	
		'Fontdiner+Swanky' => __('Fontdiner Swanky', 'options_framework_theme'),	
		'Forum' => __('Forum', 'options_framework_theme'),	
		'Francois+One' => __('Francois One', 'options_framework_theme'),	
		'Gentium+Basic' => __('Gentium Basic', 'options_framework_theme'),	
		'Gentium+Book+Basic' => __('Gentium Book Basic', 'options_framework_theme'),	
		'Geo' => __('Geo', 'options_framework_theme'),	
		'Geostar+Fill' => __('Geostar Fill', 'options_framework_theme'),	
		'Geostar' => __('Geostar', 'options_framework_theme'),	
		'Give+You+Glory' => __('Give You Glory', 'options_framework_theme'),	
		'Gloria+Hallelujah' => __('Gloria Hallelujah', 'options_framework_theme'),	
		'Goblin+One' => __('Goblin One', 'options_framework_theme'),	
		'Gochi+Hand' => __('Gochi Hand', 'options_framework_theme'),	
		'Goudy+Bookletter+1911' => __('Goudy Bookletter 1911', 'options_framework_theme'),	
		'Gravitas+One' => __('Gravitas One', 'options_framework_theme'),	
		'Gruppo' => __('Gruppo', 'options_framework_theme'),	
		'Hammersmith+One' => __('Hammersmith One', 'options_framework_theme'),	
		'Herr+Von+Muellerhoff' => __('Herr Von Muellerhoff', 'options_framework_theme'),	
		'Holtwood+One+SC' => __('Holtwood One SC', 'options_framework_theme'),	
		'Homemade+Apple' => __('Homemade Apple', 'options_framework_theme'),	
		'IM+Fell+DW+Pica+SC' => __('IM Fell DW Pica SC', 'options_framework_theme'),	
		'IM+Fell+DW+Pica' => __('IM Fell DW Pica', 'options_framework_theme'),
		'IM+Fell+Double+Pica+SC' => __('IM Fell Double Pica SC', 'options_framework_theme'),	
		'IM+Fell+Double+Pica' => __('IM Fell Double Pica', 'options_framework_theme'),	
		'IM+Fell+English+SC' => __('IM Fell English SC', 'options_framework_theme'),	
		'IM+Fell+English' => __('IM Fell English', 'options_framework_theme'),	
		'IM+Fell+French+Canon+SC' => __('IM Fell French Canon SC', 'options_framework_theme'),	
		'IM+Fell+French+Canon' => __('IM Fell French Canon', 'options_framework_theme'),	
		'IM+Fell+Great+Primer+SC' => __('IM Fell Great Primer SC', 'options_framework_theme'),	
		'IM+Fell+Great+Primer' => __('IM Fell Great Primer', 'options_framework_theme'),	
		'Iceland' => __('Iceland', 'options_framework_theme'),	
		'Inconsolata' => __('Inconsolata', 'options_framework_theme'),	
		'Indie+Flower' => __('Indie Flower', 'options_framework_theme'),	
		'Irish+Grover' => __('Irish Grover', 'options_framework_theme'),	
		'Istok+Web' => __('Istok Web', 'options_framework_theme'),	
		'Jockey+One' => __('Jockey One', 'options_framework_theme'),	
		'Josefin+Sans' => __('Josefin Sans', 'options_framework_theme'),	
		'Josefin+Slab' => __('Josefin Slab', 'options_framework_theme'),	
		'Judson' => __('Judson', 'options_framework_theme'),	
		'Julee' => __('Julee', 'options_framework_theme'),	
		'Jura' => __('Jura', 'options_framework_theme'),	
		'Just+Another+Hand' => __('Just Another Hand', 'options_framework_theme'),	
		'Just+Me+Again+Down+Here' => __('Just Me Again Down Here', 'options_framework_theme'),	
		'Kameron' => __('Kameron', 'options_framework_theme'),	
		'Kelly+Slab' => __('Kelly Slab', 'options_framework_theme'),	
		'Kenia' => __('Kenia', 'options_framework_theme'),
		'Knewave' => __('Knewave', 'options_framework_theme'),	
		'Kranky' => __('Kranky', 'options_framework_theme'),	
		'Kreon' => __('Kreon', 'options_framework_theme'),	
		'Kristi' => __('Kristi', 'options_framework_theme'),	
		'La+Belle+Aurore' => __('La Belle Aurore', 'options_framework_theme'),	
		'Lancelot' => __('Lancelot', 'options_framework_theme'),	
		'Lato' => __('Lato', 'options_framework_theme'),	
		'League+Script' => __('League Script', 'options_framework_theme'),	
		'Leckerli+One' => __('Leckerli One', 'options_framework_theme'),	
		'Lekton' => __('Lekton', 'options_framework_theme'),	
		'Lemon' => __('Lemon', 'options_framework_theme'),	
		'Limelight' => __('Limelight', 'options_framework_theme'),	
		'Linden Hill' => __('Linden Hill', 'options_framework_theme'),	
		'Lobster+Two' => __('Lobster Two', 'options_framework_theme'),	
		'Lobster' => __('Lobster', 'options_framework_theme'),	
		'Lora' => __('Lora', 'options_framework_theme'),	
		'Love+Ya+Like+A+Sister' => __('Love Ya Like A Sister', 'options_framework_theme'),	
		'Loved+by+the+King' => __('Loved by the King', 'options_framework_theme'),	
		'Luckiest+Guy' => __('Luckiest Guy', 'options_framework_theme'),	
		'Maiden+Orange' => __('Maiden Orange', 'options_framework_theme'),	
		'Mako' => __('Mako', 'options_framework_theme'),	
		'Marck+Script' => __('Marck Script', 'options_framework_theme'),	
		'Marvel' => __('Marvel', 'options_framework_theme'),	
		'Mate+SC' => __('Mate SC', 'options_framework_theme'),
		'Mate' => __('Mate', 'options_framework_theme'),	
		'Maven+Pro' => __('Maven Pro', 'options_framework_theme'),	
		'Meddon' => __('Meddon', 'options_framework_theme'),	
		'MedievalSharp' => __('MedievalSharp', 'options_framework_theme'),	
		'Megrim' => __('Megrim', 'options_framework_theme'),	
		'Merienda+One' => __('Merienda One', 'options_framework_theme'),	
		'Merriweather' => __('Merriweather', 'options_framework_theme'),
		'Merriweather+Sans' => __('Merriweather Sans', 'options_framework_theme'),		
		'Metrophobic' => __('Metrophobic', 'options_framework_theme'),	
		'Michroma' => __('Michroma', 'options_framework_theme'),	
		'Miltonian+Tattoo' => __('Miltonian Tattoo', 'options_framework_theme'),	
		'Miltonian' => __('Miltonian', 'options_framework_theme'),	
		'Miss+Fajardose' => __('Miss Fajardose', 'options_framework_theme'),	
		'Miss+Saint+Delafield' => __('Miss Saint Delafield', 'options_framework_theme'),	
		'Modern+Antiqua' => __('Modern Antiqua', 'options_framework_theme'),	
		'Molengo' => __('Molengo', 'options_framework_theme'),	
		'Monofett' => __('Monofett', 'options_framework_theme'),	
		'Monoton' => __('Monoton', 'options_framework_theme'),	
		'Monsieur+La+Doulaise' => __('Monsieur La Doulaise', 'options_framework_theme'),	
		'Montez' => __('Montez', 'options_framework_theme'),	
		'Mountains+of+Christmas' => __('Mountains of Christmas', 'options_framework_theme'),	
		'Mr+Bedford' => __('Mr Bedford', 'options_framework_theme'),	
		'Mr+Dafoe' => __('Mr Dafoe', 'options_framework_theme'),	
		'Mr+De+Haviland' => __('Mr De Haviland', 'options_framework_theme'),	
		'Mrs+Sheppards' => __('Mrs Sheppards', 'options_framework_theme'),
		'Muli' => __('Muli', 'options_framework_theme'),	
		'Neucha' => __('Neucha', 'options_framework_theme'),	
		'Neuton' => __('Neuton', 'options_framework_theme'),	
		'News+Cycle' => __('News Cycle', 'options_framework_theme'),	
		'Niconne' => __('Niconne', 'options_framework_theme'),	
		'Nixie+One' => __('Nixie One', 'options_framework_theme'),	
		'Nobile' => __('Nobile', 'options_framework_theme'),	
		'Nosifer+Caps' => __('Nosifer Caps', 'options_framework_theme'),	
		'Nothing+You+Could+Do' => __('Nothing You Could Do', 'options_framework_theme'),	
		'Nova+Cut' => __('Nova Cut', 'options_framework_theme'),	
		'Nova+Flat' => __('Nova Flat', 'options_framework_theme'),	
		'Nova+Mono' => __('Nova Mono', 'options_framework_theme'),	
		'Nova+Oval' => __('Nova Oval', 'options_framework_theme'),	
		'Nova+Round' => __('Nova Round', 'options_framework_theme'),	
		'Nova+Script' => __('Nova Script', 'options_framework_theme'),	
		'Nova+Slim' => __('Nova Slim', 'options_framework_theme'),	
		'Nova+Square' => __('Nova Square', 'options_framework_theme'),	
		'Numans' => __('Numans', 'options_framework_theme'),	
		'Nunito' => __('Nunito', 'options_framework_theme'),	
		'Old+Standard+TT' => __('Old Standard TT', 'options_framework_theme'),	
		'Open+Sans+Condensed' => __('Open Sans Condensed', 'options_framework_theme'),	
		'Open+Sans' => __('Open Sans', 'options_framework_theme'),	
		'Orbitron' => __('Orbitron', 'options_framework_theme'),	
		'Oswald' => __('Oswald', 'options_framework_theme'),
		'Over+the+Rainbow' => __('Over the Rainbow', 'options_framework_theme'),	
		'Ovo' => __('Ovo', 'options_framework_theme'),	
		'PT+Sans+Caption' => __('PT Sans Caption', 'options_framework_theme'),	
		'PT+Sans+Narrow' => __('PT Sans+Narrow', 'options_framework_theme'),	
		'PT+Sans' => __('PT Sans', 'options_framework_theme'),	
		'PT+Serif+Caption' => __('PT Serif Caption', 'options_framework_theme'),	
		'PT+Serif' => __('PT Serif', 'options_framework_theme'),	
		'Pacifico' => __('Pacifico', 'options_framework_theme'),	
		'Passero+One' => __('Passero One', 'options_framework_theme'),	
		'Patrick+Hand' => __('Patrick Hand', 'options_framework_theme'),	
		'Paytone+One' => __('Paytone One', 'options_framework_theme'),	
		'Permanent+Marker' => __('Permanent Marker', 'options_framework_theme'),	
		'Petrona' => __('Petrona', 'options_framework_theme'),	
		'Philosopher' => __('Philosopher', 'options_framework_theme'),	
		'Piedra' => __('Piedra', 'options_framework_theme'),	
		'Pinyon+Script' => __('Pinyon Script', 'options_framework_theme'),	
		'Play' => __('Play', 'options_framework_theme'),	
		'Playfair+Display' => __('Playfair Display', 'options_framework_theme'),	
		'Podkova' => __('Podkova', 'options_framework_theme'),	
		'Poller+One' => __('Poller One', 'options_framework_theme'),	
		'Poly' => __('Poly', 'options_framework_theme'),	
		'Pompiere' => __('Pompiere', 'options_framework_theme'),	
		'Prata' => __('Prata', 'options_framework_theme'),	
		'Prociono' => __('Prociono', 'options_framework_theme'),
		'Puritan' => __('Puritan', 'options_framework_theme'),	
		'Quattrocento+Sans' => __('Quattrocento Sans', 'options_framework_theme'),	
		'Quattrocento' => __('Quattrocento', 'options_framework_theme'),	
		'Questrial' => __('Questrial', 'options_framework_theme'),	
		'Quicksand' => __('Quicksand', 'options_framework_theme'),	
		'Radley' => __('Radley', 'options_framework_theme'),	
		'Raleway' => __('Raleway', 'options_framework_theme'),	
		'Rammetto+One' => __('Rammetto One', 'options_framework_theme'),	
		'Rancho' => __('Rancho', 'options_framework_theme'),	
		'Rationale' => __('Rationale', 'options_framework_theme'),	
		'Redressed' => __('Redressed', 'options_framework_theme'),	
		'Reenie+Beanie' => __('Reenie Beanie', 'options_framework_theme'),	
		'Ribeye+Marrow' => __('Ribeye Marrow', 'options_framework_theme'),	
		'Ribeye' => __('Ribeye', 'options_framework_theme'),	
		'Righteous' => __('Righteous', 'options_framework_theme'),	
		'Rochester' => __('Rochester', 'options_framework_theme'),	
		'Rock+Salt' => __('Rock Salt', 'options_framework_theme'),	
		'Rokkitt' => __('Rokkitt', 'options_framework_theme'),	
		'Rosario' => __('Rosario', 'options_framework_theme'),	
		'Ruslan+Display' => __('Ruslan Display', 'options_framework_theme'),	
		'Salsa' => __('Salsa', 'options_framework_theme'),	
		'Sancreek' => __('Sancreek', 'options_framework_theme'),
		'sans-serif' => __('sans-serif', 'options_framework_theme'),
		'Sansita+One' => __('Sansita One', 'options_framework_theme'),	
		'Satisfy' => __('Satisfy', 'options_framework_theme'),
		'Schoolbell' => __('Schoolbell', 'options_framework_theme'),
		'serif' => __('serif', 'options_framework_theme'),		
		'Shadows+Into+Light' => __('Shadows Into Light', 'options_framework_theme'),	
		'Shanti' => __('Shanti', 'options_framework_theme'),	
		'Short+Stack' => __('Short Stack', 'options_framework_theme'),	
		'Sigmar+One' => __('Sigmar One', 'options_framework_theme'),	
		'Signika+Negative' => __('Signika Negative', 'options_framework_theme'),	
		'Signika' => __('Signika', 'options_framework_theme'),	
		'Six+Caps' => __('Six Caps', 'options_framework_theme'),	
		'Slackey' => __('Slackey', 'options_framework_theme'),	
		'Smokum' => __('Smokum', 'options_framework_theme'),	
		'Smythe' => __('Smythe', 'options_framework_theme'),	
		'Sniglet' => __('Sniglet', 'options_framework_theme'),	
		'Snippet' => __('Snippet', 'options_framework_theme'),
		'Source+Sans+Pro' => __('Source Sans Pro', 'options_framework_theme'),		
		'Sorts+Mill+Goudy' => __('Sorts Mill Goudy', 'options_framework_theme'),	
		'Special+Elite' => __('Special Elite', 'options_framework_theme'),	
		'Spinnaker' => __('Spinnaker', 'options_framework_theme'),	
		'Spirax' => __('Spirax', 'options_framework_theme'),	
		'Stardos+Stencil' => __('Stardos Stencil', 'options_framework_theme'),	
		'Sue+Ellen+Francisco' => __('Sue Ellen Francisco', 'options_framework_theme'),	
		'Sunshiney' => __('Sunshiney', 'options_framework_theme'),	
		'Supermercado+One' => __('Supermercado One', 'options_framework_theme'),	
		'Swanky+and+Moo+Moo' => __('Swanky and Moo Moo', 'options_framework_theme'),	
		'Syncopate' => __('Syncopate', 'options_framework_theme'),	
		'Tangerine' => __('Tangerine', 'options_framework_theme'),
		'Tenor+Sans' => __('Tenor Sans', 'options_framework_theme'),	
		'Terminal+Dosis' => __('Terminal Dosis', 'options_framework_theme'),	
		'The+Girl+Next+Door' => __('The Girl Next Door', 'options_framework_theme'),	
		'Tienne' => __('Tienne', 'options_framework_theme'),	
		'Tinos' => __('Tinos', 'options_framework_theme'),	
		'Tulpen+One' => __('Tulpen One', 'options_framework_theme'),	
		'Ubuntu+Condensed' => __('Ubuntu Condensed', 'options_framework_theme'),	
		'Ubuntu+Mono' => __('Ubuntu Mono', 'options_framework_theme'),	
		'Ubuntu' => __('Ubuntu', 'options_framework_theme'),	
		'Ultra' => __('Ultra', 'options_framework_theme'),	
		'UnifrakturCook' => __('UnifrakturCook', 'options_framework_theme'),	
		'UnifrakturMaguntia' => __('UnifrakturMaguntia', 'options_framework_theme'),	
		'Unkempt' => __('Unkempt', 'options_framework_theme'),	
		'Unlock' => __('Unlock', 'options_framework_theme'),	
		'Unna' => __('Unna', 'options_framework_theme'),	
		'VT323' => __('VT323', 'options_framework_theme'),	
		'Varela+Round' => __('Varela Round', 'options_framework_theme'),	
		'Varela' => __('Varela', 'options_framework_theme'),	
		'Vast+Shadow' => __('Vast Shadow', 'options_framework_theme'),	
		'Vibur' => __('Vibur', 'options_framework_theme'),	
		'Vidaloka' => __('Vidaloka', 'options_framework_theme'),	
		'Volkhov' => __('Volkhov', 'options_framework_theme'),	
		'Vollkorn' => __('Vollkorn', 'options_framework_theme'),	
		'Voltaire' => __('Voltaire', 'options_framework_theme'),
		'Waiting+for+the+Sunrise' => __('Waiting for the Sunrise', 'options_framework_theme'),
		'Wallpoet' => __('Wallpoet', 'options_framework_theme'),
		'Walter+Turncoat' => __('Walter Turncoat', 'options_framework_theme'),
		'Wire+One' => __('Wire One', 'options_framework_theme'),
		'Yanone+Kaffeesatz' => __('Yanone Kaffeesatz', 'options_framework_theme'),
		'Yellowtail' => __('Yellowtail', 'options_framework_theme'),
		'Yeseva+One' => __('Yeseva One', 'options_framework_theme'),
		'Zeyada' => __('Zeyada', 'options_framework_theme'),
		
	);



/*--------------------------------*/
/* Responsive Array */
/*--------------------------------*/
	$responsive_array = array(
		'On' => __('On', 'options_framework_theme'),
		'Off' => __('Off', 'options_framework_theme')		
	);	

/*--------------------------------*/
/* Layout Array */
/*--------------------------------*/
	$layout_array = array(
		'Wide' => __('Wide', 'options_framework_theme'),
		'Boxed' => __('Boxed', 'options_framework_theme')		
	);	
	

/*--------------------------------*/
/* Header Options Array */
/*--------------------------------*/
	$menu_array = array(
		'Opened' => __('Opened', 'options_framework_theme'),
		'Closed' => __('Closed', 'options_framework_theme')	
	);	

	
/*--------------------------------*/
/* Static/Slider Header Array */
/*--------------------------------*/
	$static_array = array(
		'Image' => __('Image', 'options_framework_theme'),
		'Video' => __('Video', 'options_framework_theme')	
	);	

/*--------------------------------*/
/* Header Options Array */
/*--------------------------------*/
	$header_array = array(
		'HeaderOne' => __('Slider First', 'options_framework_theme'),
		'HeaderTwo' => __('Menu First', 'options_framework_theme'),
		'HeaderThree' => __('Menu shown while scrolling', 'options_framework_theme')	
	);	


	
/*--------------------------------*/
/* Shop Array */
/*--------------------------------*/
	$shop_array = array(
		'Full' => __('Full', 'options_framework_theme'),
		'With Sidebar' => __('With Sidebar', 'options_framework_theme')		
	);	

	

/*--------------------------------*/
/* Categories Begin */
/*--------------------------------*/
	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
/*--------------------------------*/
/* Categories End */
/*--------------------------------*/


/*--------------------------------*/
/* Tags Begin */
/*--------------------------------*/	
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}
/*--------------------------------*/
/* Tags End */
/*--------------------------------*/	



/*--------------------------------*/
/* Options Page Begin */
/*--------------------------------*/	
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
/*--------------------------------*/
/* Options Page End */
/*--------------------------------*/	



/*--------------------------------*/
/* Variables Start */
/*--------------------------------*/
	$imagepath =  get_template_directory_uri() . '/images/';
	$options = array();	
/*--------------------------------*/
/* Variables End */
/*--------------------------------*/

	
/*--------------------------------*/
/* Site Options Start */
/*--------------------------------*/
	$options[] = array(
		'name' => __('Site Options', 'options_framework_theme'),
		'type' => 'heading');	
	
	$options[] = array(
	'name' => __('Please choose Site Font', 'options_framework_theme'),
	'desc' => __('The font that will be displayed for the whole site.', 'options_framework_theme'),
	'id' => 'select_font',
	'std' => 'Open+Sans',
	'type' => 'select',
	'options' => $fonts_array);

	$options[] = array(
	'name' => __('Please choose a color for the Site', 'options_framework_theme'),
	'desc' => __('This color will be your site color (Links, borders, ...etc)', 'options_framework_theme'),
	'id' => 'theme_color',
	'std' => '#1795c5',
	'type' => 'color' );			

	$options[] = array(
	'name' => __('Please choose a color for the Menu items', 'options_framework_theme'),
	'desc' => __('This color will be your menu items color', 'options_framework_theme'),
	'id' => 'menu_color',
	'std' => '#ffffff',
	'type' => 'color' );		
	
	$options[] = array(
	'name' => __('Please choose a color for the Menu items Hover state', 'options_framework_theme'),
	'desc' => __('This color will be your menu items color in Hover state', 'options_framework_theme'),
	'id' => 'menu_color_hover',
	'std' => '#1795c5',
	'type' => 'color' );		
	
	$options[] = array(
	'name' => __('Display Search on Header?', 'options_framework_theme'),
	'desc' => __('On/Off Search on Header', 'options_framework_theme'),
	'id' => 'select_header_search',
	'std' => 'On',
	'type' => 'select',
	'options' => $responsive_array);	
	
	$options[] = array(
	'name' => __('Display Back to Top link?', 'options_framework_theme'),
	'desc' => __('On/Off Back to Top link', 'options_framework_theme'),
	'id' => 'select_backtotop',
	'std' => 'On',
	'type' => 'select',
	'options' => $responsive_array);	
	
	$options[] = array(
	'name' => __('Please choose a background image for Page Title section', 'options_framework_theme'),
	'desc' => __('Upload your own image here', 'options_framework_theme'),
	'id' => 'page_title_image',
	'std' => get_template_directory_uri() . '/images/polygon-bg-blue.png',
	'type' => 'upload');
	
	$options[] = array(
	'name' => __('Please choose text color for Page Title section', 'options_framework_theme'),
	'desc' => __('This color will be your text color for Page Title section', 'options_framework_theme'),
	'id' => 'page_title_color',
	'std' => '#ffffff',
	'type' => 'color' );		
	
/*--------------------------------*/
/* Site Options End */
/*--------------------------------*/



/*--------------------------------*/
/* Homepage Slider Options - Begin */
/*--------------------------------*/	

	$options[] = array(
		'name' => __('Homepage Slider Options', 'options_framework_theme'),
		'type' => 'heading');
		
		
	$options[] = array(
	'name' => __('Enable/Disable Slider in the Homepage Header', 'options_framework_theme'),
	'desc' => __('If Enabled (On) then slider will be shown, else (Off) a static header will be shown', 'options_framework_theme'),
	'id' => 'page_slider_option',
	'std' => 'On',
	'type' => 'select',
	'options' => $responsive_array);

	$options[] = array(
	'name' => __('Please enter Rev Slider ShortCode', 'options_framework_theme'),
	'desc' => __('This will be used if the Slider option above is enabled', 'options_framework_theme'),
	'id' => 'page_slider',
	'std' => '',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => __('Please choose a Background image for the Static Header Option', 'options_framework_theme'),
	'desc' => __('Upload your own Background Image here which will be used with Static header if the Slider option above is disabled', 'options_framework_theme'),
	'id' => 'slider_background_image',
	'std' => get_template_directory_uri() . '/images/polygon-bg-blue.jpg',
	'type' => 'upload');	


	$options[] = array(
	'name' => __('Please enter section Title', 'options_framework_theme'),
	'desc' => __('This will be used as Header Title if the Slider option above is disabled', 'options_framework_theme'),
	'id' => 'main_text_slider',
	'std' => 'Welcome to Nexus',
	'class' => 'mini',
	'type' => 'text');
	
	$options[] = array(
	'name' => __('Please enter section Sub Title', 'options_framework_theme'),
	'desc' => __('This will be used as Header Sub Title if the Slider option above is disabled', 'options_framework_theme'),
	'id' => 'main_subtext_slider',
	'std' => 'A Modern HTML Template',
	'class' => 'mini',
	'type' => 'text');	
		
	$options[] = array(
	'name' => __('Please enter a Description Sentences for the Static Header Option, separated by coma', 'options_framework_theme'),
	'desc' => __('This will be used if the Slider option above is disabled', 'options_framework_theme'),
	'id' => 'main_description_slider',
	'std' => 'Start your new project with a fresh approach. Nexus is truly cutting edge in terms of design and performance; leave your visitors with an experience to remember and Purchase Nexus now.',
	'type' => 'textarea');

	$options[] = array(
	'name' => __('Please enter first button title', 'options_framework_theme'),
	'desc' => __('This will be used as Button Title if the Slider option above is disabled', 'options_framework_theme'),
	'id' => 'first_button_text',
	'std' => 'Purchase Now',
	'class' => 'mini',
	'type' => 'text');		
	
	$options[] = array(
	'name' => __('Please enter first button URL', 'options_framework_theme'),
	'desc' => __('This will be used as Button URL and you can keep it empty to hide the button', 'options_framework_theme'),
	'id' => 'first_button_url',
	'std' => 'http://www.example.com',
	'class' => 'mini',
	'type' => 'text');		
	
	$options[] = array(
	'name' => __('Please enter second button title', 'options_framework_theme'),
	'desc' => __('This will be used as Button Title if the Slider option above is disabled', 'options_framework_theme'),
	'id' => 'second_button_text',
	'std' => 'Read More',
	'class' => 'mini',
	'type' => 'text');		
	
	$options[] = array(
	'name' => __('Please enter second button URL', 'options_framework_theme'),
	'desc' => __('This will be used as Button URL and you can keep it empty to hide the button', 'options_framework_theme'),
	'id' => 'second_button_url',
	'std' => 'http://www.example.com',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => __('Enable/Disable Static Header down arrow', 'options_framework_theme'),
	'desc' => __('If Enabled (On) then down arrow will be shown, else (Off) the down arrow will be disabled', 'options_framework_theme'),
	'id' => 'slider_arrow_option',
	'std' => 'On',
	'type' => 'select',
	'options' => $responsive_array);
	
/*--------------------------------*/
/* Homepage Slider Options - End */
/*--------------------------------*/	

	


/*--------------------------------*/
/* Headings Begin */
/*--------------------------------*/	

	$options[] = array(
		'name' => __('Headings Options', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
	'name' => __('Please choose a font family for your H1 Headings', 'options_framework_theme'),
	'desc' => __('This font family will be displayed for all H1 headings in your site.', 'options_framework_theme'),
	'id' => 'h1_font',
	'std' => 'Open+Sans',
	'type' => 'select',
	'options' => $fonts_array);
	
	$options[] = array(
	'name' => __('Please choose a color for your H1 Headings', 'options_framework_theme'),
	'desc' => __('This color will be displayed for all H1 headings in your site.', 'options_framework_theme'),
	'id' => 'h1_color',
	'std' => '#121212',
	'type' => 'color' );
	
	$options[] = array(
	'name' => __('Please choose a font size for your H1 Headings', 'options_framework_theme'),
	'desc' => __('This font size will be displayed for all H1 headings in your site.', 'options_framework_theme'),
	'id' => 'h1_font_size',
	'std' => '27px',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => __('Please choose a line height for your H1 Headings', 'options_framework_theme'),
	'desc' => __('This line height will be displayed for all H1 headings in your site.', 'options_framework_theme'),
	'id' => 'h1_line_height',
	'std' => '1.4',
	'class' => 'mini',
	'type' => 'text');		

	
	$options[] = array(
	'name' => __('Please choose a font family for your H2 Headings', 'options_framework_theme'),
	'desc' => __('This font family will be displayed for all H2 headings in your site.', 'options_framework_theme'),
	'id' => 'h2_font',
	'std' => 'Open+Sans',
	'type' => 'select',
	'options' => $fonts_array);	
	
	$options[] = array(
	'name' => __('Please choose a color for your H2 Headings', 'options_framework_theme'),
	'desc' => __('This color will be displayed for all H2 headings in your site.', 'options_framework_theme'),
	'id' => 'h2_color',
	'std' => '#121212',
	'type' => 'color' );

	$options[] = array(
	'name' => __('Please choose a font size for your H2 Headings', 'options_framework_theme'),
	'desc' => __('This font size will be displayed for all H2 headings in your site.', 'options_framework_theme'),
	'id' => 'h2_font_size',
	'std' => '24px',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => __('Please choose a line height for your H2 Headings', 'options_framework_theme'),
	'desc' => __('This line height will be displayed for all H2 headings in your site.', 'options_framework_theme'),
	'id' => 'h2_line_height',
	'std' => '1.4',
	'class' => 'mini',
	'type' => 'text');		
	
	
	
	
	$options[] = array(
	'name' => __('Please choose a font family for your H3 Headings', 'options_framework_theme'),
	'desc' => __('This font family will be displayed for all H3 headings in your site.', 'options_framework_theme'),
	'id' => 'h3_font',
	'std' => 'Open+Sans',
	'type' => 'select',
	'options' => $fonts_array);		
	
	$options[] = array(
	'name' => __('Please choose a color for your H3 Headings', 'options_framework_theme'),
	'desc' => __('This color will be displayed for all H3 headings in your site.', 'options_framework_theme'),
	'id' => 'h3_color',
	'std' => '#121212',
	'type' => 'color' );

	$options[] = array(
	'name' => __('Please choose a font size for your H3 Headings', 'options_framework_theme'),
	'desc' => __('This font size will be displayed for all H3 headings in your site.', 'options_framework_theme'),
	'id' => 'h3_font_size',
	'std' => '21px',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => __('Please choose a line height for your H3 Headings', 'options_framework_theme'),
	'desc' => __('This line height will be displayed for all H3 headings in your site.', 'options_framework_theme'),
	'id' => 'h3_line_height',
	'std' => '1.4',
	'class' => 'mini',
	'type' => 'text');	

	


	$options[] = array(
	'name' => __('Please choose a font family for your H4 Headings', 'options_framework_theme'),
	'desc' => __('This font family will be displayed for all H4 headings in your site.', 'options_framework_theme'),
	'id' => 'h4_font',
	'std' => 'Open+Sans',
	'type' => 'select',
	'options' => $fonts_array);	
	
	$options[] = array(
	'name' => __('Please choose a color for your H4 Headings', 'options_framework_theme'),
	'desc' => __('This color will be displayed for all H4 headings in your site.', 'options_framework_theme'),
	'id' => 'h4_color',
	'std' => '#121212',
	'type' => 'color' );

	$options[] = array(
	'name' => __('Please choose a font size for your H4 Headings', 'options_framework_theme'),
	'desc' => __('This font size will be displayed for all H4 headings in your site.', 'options_framework_theme'),
	'id' => 'h4_font_size',
	'std' => '18px',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => __('Please choose a line height for your H4 Headings', 'options_framework_theme'),
	'desc' => __('This line height will be displayed for all H4 headings in your site.', 'options_framework_theme'),
	'id' => 'h4_line_height',
	'std' => '1.4',
	'class' => 'mini',
	'type' => 'text');		
	
	
	$options[] = array(
	'name' => __('Please choose a font family for your H5 Headings', 'options_framework_theme'),
	'desc' => __('This font family will be displayed for all H5 headings in your site.', 'options_framework_theme'),
	'id' => 'h5_font',
	'std' => 'Open+Sans',
	'type' => 'select',
	'options' => $fonts_array);		
	
	$options[] = array(
	'name' => __('Please choose a color for your H5 Headings', 'options_framework_theme'),
	'desc' => __('This color will be displayed for all H5 headings in your site.', 'options_framework_theme'),
	'id' => 'h5_color',
	'std' => '#121212',
	'type' => 'color' );

	$options[] = array(
	'name' => __('Please choose a font size for your H5 Headings', 'options_framework_theme'),
	'desc' => __('This font size will be displayed for all H5 headings in your site.', 'options_framework_theme'),
	'id' => 'h5_font_size',
	'std' => '15px',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => __('Please choose a line height for your H5 Headings', 'options_framework_theme'),
	'desc' => __('This line height will be displayed for all H5 headings in your site.', 'options_framework_theme'),
	'id' => 'h5_line_height',
	'std' => '1.4',
	'class' => 'mini',
	'type' => 'text');	

	
	$options[] = array(
	'name' => __('Please choose a font family for your H6 Headings', 'options_framework_theme'),
	'desc' => __('This font family will be displayed for all H6 headings in your site.', 'options_framework_theme'),
	'id' => 'h6_font',
	'std' => 'Open+Sans',
	'type' => 'select',
	'options' => $fonts_array);	
		
	
	$options[] = array(
	'name' => __('Please choose a color for your H6 Headings', 'options_framework_theme'),
	'desc' => __('This color will be displayed for all H6 headings in your site.', 'options_framework_theme'),
	'id' => 'h6_color',
	'std' => '#121212',
	'type' => 'color' );	
	
	$options[] = array(
	'name' => __('Please choose a font size for your H6 Headings', 'options_framework_theme'),
	'desc' => __('This font size will be displayed for all H6 headings in your site.', 'options_framework_theme'),
	'id' => 'h6_font_size',
	'std' => '13px',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => __('Please choose a line height for your H6 Headings', 'options_framework_theme'),
	'desc' => __('This line height will be displayed for all H6 headings in your site.', 'options_framework_theme'),
	'id' => 'h6_line_height',
	'std' => '1.4',
	'class' => 'mini',
	'type' => 'text');	
	
/*--------------------------------*/
/* Headings End */
/*--------------------------------*/	


/*--------------------------------*/
/* Logo & Favicon Begin */
/*--------------------------------*/	
	$options[] = array(
		'name' => __('Logo & Favicon Options', 'options_framework_theme'),
		'type' => 'heading');	

	$options[] = array(
	'name' => __('Do you want to display a Logo on your site?', 'options_framework_theme'),
	'desc' => __('On/Off your Site Logo', 'options_framework_theme'),
	'id' => 'select_display_logo',
	'std' => 'On',
	'type' => 'select',
	'options' => $responsive_array);
	
	
	$options[] = array(
	'name' => __('Please choose a logo for your Site', 'options_framework_theme'),
	'desc' => __('Upload your own logo here (Suggest: 118 X 36 pixel)', 'options_framework_theme'),
	'id' => 'theme_logo',
	'std' => get_template_directory_uri() . '/images/logo.png',
	'type' => 'upload');
	
	$options[] = array(
	'name' => __('Please enter the padding top value for the Logo in PIXELS', 'options_framework_theme'),
	'desc' => __('This is the Space between the logo container and the top of the container', 'options_framework_theme'),
	'id' => 'theme_site_logo_padding_top',
	'std' => '2px',
	'class' => 'mini',
	'type' => 'text');
	
	$options[] = array(
	'name' => __('Please enter the padding bottom value for the Logo in PIXELS', 'options_framework_theme'),
	'desc' => __('This is the Space between the logo container and the bottom of the container', 'options_framework_theme'),
	'id' => 'theme_site_logo_padding_bottom',
	'std' => '0px',
	'class' => 'mini',
	'type' => 'text');
	
	$options[] = array(
	'name' => __('Please enter the padding left value for the Logo in PIXELS', 'options_framework_theme'),
	'desc' => __('This is the Space between the logo container and the left of the container', 'options_framework_theme'),
	'id' => 'theme_site_logo_padding_left',
	'std' => '0px',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => __('Please enter the padding right value for the Logo in PIXELS', 'options_framework_theme'),
	'desc' => __('This is the Space between the logo container and the right of the container', 'options_framework_theme'),
	'id' => 'theme_site_logo_padding_right',
	'std' => '0px',
	'class' => 'mini',
	'type' => 'text');		
	
	$options[] = array(
	'name' => __('Please enter a text to display instead of the logo if you chosen not to display logo from the above options', 'options_framework_theme'),
	'desc' => __('This text will be shown instead of logo there is no logo uploaded to the site or if you chosen not to display the logo from the above options.', 'options_framework_theme'),
	'id' => 'theme_site_logo_text',
	'std' => 'Nexus',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => __('Please enter your (16 X 16) Favicon', 'options_framework_theme'),
	'desc' => __('This Favicon will be displayed within your browser', 'options_framework_theme'),
	'id' => 'theme_favicon',
	'type' => 'upload');	
	
/*--------------------------------*/
/* Logo & Favicon End */
/*--------------------------------*/	



/*--------------------------------*/
/* Contact Options Start */
/*--------------------------------*/
	$options[] = array(
		'name' => __('Contact Information', 'options_framework_theme'),
		'type' => 'heading');
	
	$options[] = array(
	'name' => __('Please enter your Address Title', 'options_framework_theme'),
	'desc' => __('This be used as Address label/title', 'options_framework_theme'),
	'id' => 'widget_address_title',
	'std' => 'Location',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => __('Please enter your Company Address', 'options_framework_theme'),
	'desc' => __('This will be shown in your contact widget as your Company/Business Address', 'options_framework_theme'),
	'id' => 'widget_address_one',
	'std' => 'Manhattan, New York City',
	'class' => 'mini',
	'type' => 'text');

	$options[] = array(
	'name' => __('Please enter your Phone Title', 'options_framework_theme'),
	'desc' => __('This be used as Phone label/title', 'options_framework_theme'),
	'id' => 'widget_phone_title',
	'std' => 'Phone',
	'class' => 'mini',
	'type' => 'text');		
	
	$options[] = array(
	'name' => __('Please enter your company phone No.#', 'options_framework_theme'),
	'desc' => __('This will be shown in your contact widget as your Contact/Business phone No.#', 'options_framework_theme'),
	'id' => 'widget_phone',
	'std' => '(212) 123 4567',
	'class' => 'mini',
	'type' => 'text');

	$options[] = array(
	'name' => __('Please enter your Mail Title', 'options_framework_theme'),
	'desc' => __('This be used as Mail label/title', 'options_framework_theme'),
	'id' => 'widget_mail_title',
	'std' => 'Email',
	'class' => 'mini',
	'type' => 'text');			
	
	$options[] = array(
	'name' => __('Please enter your company mail', 'options_framework_theme'),
	'desc' => __('This will be shown in your contact widget as your Contact/Business mail', 'options_framework_theme'),
	'id' => 'widget_mail',
	'std' => 'support@themeforest.net',
	'class' => 'mini',
	'type' => 'text');


	
/*--------------------------------*/
/* Contact Options End */
/*--------------------------------*/

	
	
/*--------------------------------*/
/* Site Social Begin */
/*--------------------------------*/	
	$options[] = array(
		'name' => __('Site Social Media', 'options_framework_theme'),
		'type' => 'heading');		
	
	
	$options[] = array(
		'name' => __('Please enter your FaceBook page URL', 'options_framework_theme'),
		'desc' => __('This link will be used by your users to navigate to your Facebook page from your site header.', 'options_framework_theme'),
		'id' => 'facebook_user_account',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Please enter your Twitter page URL', 'options_framework_theme'),
		'desc' => __('This link will be used by your users to navigate to your Twitter page from your site header.', 'options_framework_theme'),
		'id' => 'twitter_user_account',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Please enter your Dribbble page URL', 'options_framework_theme'),
		'desc' => __('This link will be used by your users to navigate to your Dribbble page from your site header.', 'options_framework_theme'),
		'id' => 'dribbble_user_account',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');		
		
	$options[] = array(
		'name' => __('Please enter your Pinterest page URL', 'options_framework_theme'),
		'desc' => __('This link will be used by your users to navigate to your Pinterest page from your site header.', 'options_framework_theme'),
		'id' => 'pinterest_user_account',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');


	$options[] = array(
		'name' => __('Please enter your LinkedIn page URL', 'options_framework_theme'),
		'desc' => __('This link will be used by your users to navigate to your LinkedIn page from your site header.', 'options_framework_theme'),
		'id' => 'linkedin_user_account',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Please enter your RSS page URL', 'options_framework_theme'),
		'desc' => __('This link will be used by your users to navigate to your RSS page from your site header.', 'options_framework_theme'),
		'id' => 'rss_user_account',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Please enter your Skype ID', 'options_framework_theme'),
		'desc' => __('This link will be used by your users to know your Skype ID.', 'options_framework_theme'),
		'id' => 'skype_user_account',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Please enter your Google+ page URL', 'options_framework_theme'),
		'desc' => __('This link will be used by your users to navigate to your Google+ page from your site header.', 'options_framework_theme'),
		'id' => 'google_user_account',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Please enter your Behance page URL', 'options_framework_theme'),
		'desc' => __('This link will be used by your users to navigate to your Behance page from your site header.', 'options_framework_theme'),
		'id' => 'behance_user_account',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');		
		
		
	$options[] = array(
		'name' => __('Please enter your Deviantart page URL', 'options_framework_theme'),
		'desc' => __('This link will be used by your users to navigate to your Deviantart page from your site header.', 'options_framework_theme'),
		'id' => 'deviantart_user_account',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Please enter your Instagram page URL', 'options_framework_theme'),
		'desc' => __('This link will be used by your users to navigate to your Instagram page from your site header.', 'options_framework_theme'),
		'id' => 'instagram_user_account',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');			
/*--------------------------------*/
/* Site Social End */
/*--------------------------------*/	
	


/*--------------------------------*/
/* Site Footer Begin */
/*--------------------------------*/			
	$options[] = array(
		'name' => __('Footer Options', 'options_framework_theme'),
		'type' => 'heading' );
			
	
	$options[] = array(
	'name' => __('Do you want to display Columns Section in the footer?', 'options_framework_theme'),
	'desc' => __('On/Off Columns Section', 'options_framework_theme'),
	'id' => 'select_columns_columns',
	'std' => 'On',
	'type' => 'select',
	'options' => $responsive_array);		
	
	$options[] = array(
	'name' => __('Please choose a color for your Footer section', 'options_framework_theme'),
	'desc' => __('This color will be used as a background color on your footer section', 'options_framework_theme'),
	'id' => 'foo_color',
	'std' => '#242424',
	'type' => 'color' );	
		
		
	$options[] = array(
	'name' => __('Please choose headings color for your Footer section', 'options_framework_theme'),
	'desc' => __('This color will be used as a headings color on your footer section', 'options_framework_theme'),
	'id' => 'foo_heading_color',
	'std' => '#ffffff',
	'type' => 'color' );			
		
		
	$options[] = array(
	'name' => __('Please choose text color for your Footer section', 'options_framework_theme'),
	'desc' => __('This color will be used as a text color on your footer section', 'options_framework_theme'),
	'id' => 'foo_text_color',
	'std' => '#b2b2b2',
	'type' => 'color' );			
		
		
	$options[] = array(
	'name' => __('Do you want to display the Copyrights Section in the footer?', 'options_framework_theme'),
	'desc' => __('On/Off Copyrights Section', 'options_framework_theme'),
	'id' => 'select_copyrights_columns',
	'std' => 'On',
	'type' => 'select',
	'options' => $responsive_array);		

	
	$options[] = array(
	'name' => __('Please enter your Copyrights Text', 'options_framework_theme'),
	'desc' => __('This text will be shown as a Copyrights text in your footer section.', 'options_framework_theme'),
	'id' => 'footer_text',
	'std' => 'Your Website 2015',
	'type' => 'textarea');
	
	$options[] = array(
	'name' => __('Please choose background color for your Copyrights section', 'options_framework_theme'),
	'desc' => __('This color will be used as a background color on your Copyrights section', 'options_framework_theme'),
	'id' => 'foo_copyrights_back_color',
	'std' => '#111111',
	'type' => 'color' );		
	
	$options[] = array(
	'name' => __('Please choose text color for your Copyrights section', 'options_framework_theme'),
	'desc' => __('This color will be used as a text color on your Copyrights section', 'options_framework_theme'),
	'id' => 'foo_copyrights_text_color',
	'std' => '#b2b2b2',
	'type' => 'color' );		
	
	$options[] = array(
	'name' => __('Do you want to display a Menu in your Footer?', 'options_framework_theme'),
	'desc' => __('On/Off Menu in Footer Section', 'options_framework_theme'),
	'id' => 'select_menu_footer',
	'std' => 'Off',
	'type' => 'select',
	'options' => $responsive_array);

	$options[] = array(
		'name' => __('Footer Menu replacement text', 'options_framework_theme'),
		'desc' => __('This text will be displayed in your footer if you disabled the menu in the above option.', 'options_framework_theme'),
		'id' => 'select_menu_text',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');	

/*--------------------------------*/
/* Site Footer End */
/*--------------------------------*/	


/*--------------------------------*/
/* Ribbon Options */
/*--------------------------------*/	
	$options[] = array(
		'name' => __('Pricing Table - Options', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
	'name' => __('Please choose fore color for Pricing table ribbon', 'options_framework_theme'),
	'desc' => __('This color will be used as fore ribbon color on your Pricing tables', 'options_framework_theme'),
	'id' => 'pricing_ribbon_fore_color',
	'std' => '#62c462',
	'type' => 'color' );
	
	$options[] = array(
	'name' => __('Please choose back color for Pricing table ribbon', 'options_framework_theme'),
	'desc' => __('This color will be used as back ribbon color on your Pricing tables', 'options_framework_theme'),
	'id' => 'pricing_ribbon_back_color',
	'std' => '#51a351',
	'type' => 'color' );	
/*--------------------------------*/
/* Ribbon Options */
/*--------------------------------*/


/*--------------------------------*/
/* Portfolio Page */
/*--------------------------------*/	
	$options[] = array(
		'name' => __('Portfolio Settings - Options', 'options_framework_theme'),
		'type' => 'heading');
	
	$options[] = array(
	'name' => __('Do you want to display Nexus title above your portfolio items?', 'options_framework_theme'),
	'desc' => __('On/Off Nexus title for Portfolio page', 'options_framework_theme'),
	'id' => 'select_title_portfolio',
	'std' => 'On',
	'type' => 'select',
	'options' => $responsive_array);		

	$options[] = array(
	'name' => __('Please enter Title word', 'options_framework_theme'),
	'desc' => __('This is Title normal word (will be displayed if title option is enabled)', 'options_framework_theme'),
	'id' => 'portfolio_title_word',
	'std' => 'Our',
	'class' => 'mini',
	'type' => 'text');

	$options[] = array(
	'name' => __('Please enter Title highlighted word', 'options_framework_theme'),
	'desc' => __('This is Title highlighted word (will be displayed if title option is enabled)', 'options_framework_theme'),
	'id' => 'portfolio_title_highlighted_word',
	'std' => 'Portfolio',
	'class' => 'mini',
	'type' => 'text');

	$options[] = array(
	'name' => __('Please enter Subtitle text', 'options_framework_theme'),
	'desc' => __('This is Subtitle (will be displayed if title option is enabled)', 'options_framework_theme'),
	'id' => 'portfolio_subtitle_text',
	'std' => 'Some of our Recent Works',
	'class' => 'mini',
	'type' => 'text');	

	$options[] = array(
	'name' => __('Please enter Description text', 'options_framework_theme'),
	'desc' => __('This is Description (will be displayed if title option is enabled)', 'options_framework_theme'),
	'id' => 'portfolio_description_text',
	'std' => 'Suspendisse tempus sodales neque, eget eleifend turpis tristique eu. Nullam a nisl maximus, ultrices est ut blandit nislr, elit in lobortis mattis.',
	'type' => 'textarea');	

	$options[] = array(
	'name' => __('Title section color', 'options_framework_theme'),
	'desc' => __('This color will be used as normal text color', 'options_framework_theme'),
	'id' => 'portfolio_text_color',
	'std' => '#111111',
	'type' => 'color' );

	$options[] = array(
	'name' => __('Title highlighted word color', 'options_framework_theme'),
	'desc' => __('This color will be used for highlighted word color', 'options_framework_theme'),
	'id' => 'portfolio_highlighted_text_color',
	'std' => '#1795c5',
	'type' => 'color' );		
	
/*--------------------------------*/
/* Portfolio Page */
/*--------------------------------*/	

/*--------------------------------*/
/* Blog Page */
/*--------------------------------*/	
	$options[] = array(
		'name' => __('Post Single Page - Options', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
	'name' => __('Do you want to show (About Author) section in the Single Post Page?', 'options_framework_theme'),
	'desc' => __('On/Off (About Author) Section', 'options_framework_theme'),
	'id' => 'blog_author_option',
	'std' => 'On',
	'type' => 'select',
	'options' => $responsive_array);
	

	$options[] = array(
	'name' => __('Please enter Title for Author section', 'options_framework_theme'),
	'desc' => __('This is Title will be shown above Author section', 'options_framework_theme'),
	'id' => 'blog_author_title',
	'std' => 'The Author',
	'class' => 'mini',
	'type' => 'text');

	
	$options[] = array(
	'name' => __('Do you want to show (Related Posts) section in the Single Post Page?', 'options_framework_theme'),
	'desc' => __('On/Off (Related Posts) Section', 'options_framework_theme'),
	'id' => 'blog_related_option',
	'std' => 'On',
	'type' => 'select',
	'options' => $responsive_array);	
	
	$options[] = array(
	'name' => __('Please enter Title for Related Posts section', 'options_framework_theme'),
	'desc' => __('This is Title will be shown above Related Posts section', 'options_framework_theme'),
	'id' => 'blog_related_title',
	'std' => 'Related Posts',
	'class' => 'mini',
	'type' => 'text');	
	
/*--------------------------------*/
/* Blog Page */
/*--------------------------------*/	
	$options[] = array(
		'name' => __('Blog - Options', 'options_framework_theme'),
		'type' => 'heading');

	
	$options[] = array(
	'name' => __('Do you want to display Nexus title above your blog items?', 'options_framework_theme'),
	'desc' => __('On/Off Nexus title for Blog page', 'options_framework_theme'),
	'id' => 'select_title_blog',
	'std' => 'On',
	'type' => 'select',
	'options' => $responsive_array);		

	$options[] = array(
	'name' => __('Please enter Title word', 'options_framework_theme'),
	'desc' => __('This is Title normal word (will be displayed if title option is enabled)', 'options_framework_theme'),
	'id' => 'blog_title_word',
	'std' => 'Our',
	'class' => 'mini',
	'type' => 'text');

	$options[] = array(
	'name' => __('Please enter Title highlighted word', 'options_framework_theme'),
	'desc' => __('This is Title highlighted word (will be displayed if title option is enabled)', 'options_framework_theme'),
	'id' => 'blog_title_highlighted_word',
	'std' => 'Blog',
	'class' => 'mini',
	'type' => 'text');

	$options[] = array(
	'name' => __('Please enter Subtitle text', 'options_framework_theme'),
	'desc' => __('This is Subtitle (will be displayed if title option is enabled)', 'options_framework_theme'),
	'id' => 'blog_subtitle_text',
	'std' => 'Read About Our News',
	'class' => 'mini',
	'type' => 'text');	

	$options[] = array(
	'name' => __('Please enter Description text', 'options_framework_theme'),
	'desc' => __('This is Description (will be displayed if title option is enabled)', 'options_framework_theme'),
	'id' => 'blog_description_text',
	'std' => 'Suspendisse tempus sodales neque, eget eleifend turpis tristique eu. Nullam a nisl maximus, ultrices est ut blandit nislr, elit in lobortis mattis.',
	'type' => 'textarea');	

	$options[] = array(
	'name' => __('Title section color', 'options_framework_theme'),
	'desc' => __('This color will be used as normal text color', 'options_framework_theme'),
	'id' => 'blog_text_color',
	'std' => '#111111',
	'type' => 'color' );

	$options[] = array(
	'name' => __('Title highlighted word color', 'options_framework_theme'),
	'desc' => __('This color will be used for highlighted word color', 'options_framework_theme'),
	'id' => 'blog_highlighted_text_color',
	'std' => '#1795c5',
	'type' => 'color' );		
	
/*--------------------------------*/
/* Blog Page */
/*--------------------------------*/	


/*--------------------------------*/
/* Index Page */
/*--------------------------------*/	
	$options[] = array(
		'name' => __('Index Page - Options', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
	'name' => __('Please enter Index page Title', 'options_framework_theme'),
	'desc' => __('This title will be used for your index page', 'options_framework_theme'),
	'id' => 'index_title',
	'std' => 'Index Page',
	'class' => 'mini',
	'type' => 'text');
	
	$options[] = array(
	'name' => __('Please enter Index page Sub Title', 'options_framework_theme'),
	'desc' => __('This Sub Title will be used for your index page', 'options_framework_theme'),
	'id' => 'index_sub_title',
	'std' => 'You will fall in love with Nexus!',
	'class' => 'mini',
	'type' => 'text');	
/*--------------------------------*/
/* Index Page */
/*--------------------------------*/
	




/*--------------------------------*/
/* 404 Begin */
/*--------------------------------*/	
	$options[] = array(
		'name' => __('404 Page - Options', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
	'name' => __('Please enter a page title for your 404', 'options_framework_theme'),
	'desc' => __('This Title will be displayed for any 404/incorrect page.', 'options_framework_theme'),
	'id' => 'blank_page_title',
	'std' => 'Sorry!',
	'class' => 'mini',
	'type' => 'text');
	
	$options[] = array(
	'name' => __('Please enter a brief description for your customers', 'options_framework_theme'),
	'desc' => __('This description will be displayed at the middle of the page.', 'options_framework_theme'),
	'id' => 'blank_page_desc',
	'std' => 'The page you are looking for do not exist.',
	'type' => 'textarea');		

/*--------------------------------*/
/* 404 End */
/*--------------------------------*/	



/*--------------------------------*/
/* Custom CSS Begin */
/*--------------------------------*/		
	$options[] = array(
		'name' => __('Custom CSS', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
	'name' => __('Please feel free to add any custom CSS code for your site', 'options_framework_theme'),
	'desc' => __('Here you can enter any type of a valid CSS code in order to manage your site style.', 'options_framework_theme'),
	'id' => 'css_text',
	'std' => '',
	'type' => 'textarea');		
/*--------------------------------*/
/* Custom CSS End */
/*--------------------------------*/	



	$wp_editor_settings = array(
		'wpautop' => true, 
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);
	

	return $options;
}



add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#example_showhidden').click(function() {
  		$('#section-example_text_hidden').fadeToggle(400);
	});

	if ($('#example_showhidden:checked').val() !== undefined) {
		$('#section-example_text_hidden').show();
	}

});
</script>

<?php
}