const close_alert = document.querySelector(".alert .close");

// Close alert message
close_alert.addEventListener("click", function() {
	this.parentNode.remove();
});