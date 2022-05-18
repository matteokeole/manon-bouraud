const close_alert = document.querySelector(".alert .close");

// Close alert message
if (close_alert) close_alert.addEventListener("click", function() {
	this.parentNode.remove();
});