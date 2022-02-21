export let config = {
	shell: document.querySelector('#sceptics .shell'),
	user: 'anonymous'
};

function push(message, classes) {
	let prefixed = `b{${config.user}@sceptics:~$} ${message}`;

	/* Bold */
	prefixed = prefixed.replaceAll(/b{(.+?)}/g, '<strong>$1</strong>');

	/* Italics */
	prefixed = prefixed.replaceAll(/i{(.+?)}/g, '<em>$1</em>');

	/* Color */
	prefixed = prefixed.replaceAll(/(#[0-9A-Fa-f]{6}){(.+?)}/g, '<span style="color:$1">$2</span>');

	let line = document.createElement('div');
	line.innerHTML = prefixed;
	if(classes)
		line.classList.add(classes);
	config.shell.insertBefore(line, config.cursor);

	return line;
}

function print(message) {
	push(message);
}

function show() {
	if(!config.cursor)
		config.cursor = push('', ['cursor']);
	else
		config.cursor.classList.remove('hidden');
}

function hide() {
	config.cursor.classList.add('hidden');
}

function refresh() {
	if(config.cursor)
		config.cursor.remove();
	show();
}

export let shell = {print, show, hide, refresh};