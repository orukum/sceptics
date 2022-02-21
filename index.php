<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Welcome to Sceptics</title>
	<link rel="icon" href="/assets/images/favicon.svg" type="image/svg+xml">
	<style>
		:root {
			--pupil-x-pos: 50vw;
			--pupil-y-pos: 50vh;
			--pupil-radius: 50vmin;
			--pupil-border: 3vmin;
		}
		body {
			position: absolute;
			inset: 0;
			background-color: #000000;
			overflow: hidden;
		}
		#pupil {
			z-index: -1;
			position: absolute;
			left: clamp(10vw, calc(var(--pupil-x-pos) - var(--pupil-radius) / 2 - var(--pupil-border)), calc(90vw - var(--pupil-radius) - var(--pupil-border)));
			top: clamp(10vh, calc(var(--pupil-y-pos) - var(--pupil-radius) / 2 - var(--pupil-border)), calc(90vh - var(--pupil-radius) - var(--pupil-border)));
			width: var(--pupil-radius);
			height: var(--pupil-radius);
			border: solid var(--pupil-border) #ffffff;
			border-radius: 50%;			
			transition: all 4s 0s ease-out;
		}
		#slogan {
			position: absolute;
			inset: 0;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		#slogan::before {
			display: block;
			content: "ESSE EST PERCIPI";
			font-family: sans-serif;
			font-size: 0.8em;
			font-weight: bold;
			color: rgba(0, 0, 0, 0.1);
		}
	</style>
</head>
<body>
	<div id="pupil"></div>
	<div id="slogan"></div>
	<script>
		let root = document.querySelector(':root');

		document.addEventListener('mousemove', function(event) {
			root.style.setProperty('--pupil-x-pos', event.clientX + 'px');
			root.style.setProperty('--pupil-y-pos', event.clientY + 'px');
		});

		setInterval(function() {
			root.style.setProperty('--pupil-radius', root.style.getPropertyValue('--pupil-radius') == '50vmin' ? '40vmin' : '50vmin');
		}, 4000);

		document.querySelector('#pupil').offsetTop;
		root.style.setProperty('--pupil-radius', '40vmin');
	</script>
</body>
</html>