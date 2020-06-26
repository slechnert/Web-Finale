var character_count = $('.animated-text').text().length;

$('animated-text').css('animation', 'typing 4s steps(' + character_count + ')forwards').css('font-family', 'monospace');

$('<style>@keyframes typing {from{width: 0;} to {width: ' + character_count + 'ch; } }</style>').appendTo('head');