DOM.onready(function() {
	var help = document.getElementById("help");

	if (!help) return;

	var button  = DOM.createElementWithClass("a", "help button");

	button.title = 'Show information';
	button.accessKey = "h";

	DOM.toggleClass("settings", help);

	DOM.Event.addListener(button, "click", function() {
		DOM.toggleClass("settings", help);
		this.title = DOM.hasClass("settings", help) ? 'Hide information' : 'Show information';
	});

	DOM.getFirstElement("h2").appendChild(button);
});
