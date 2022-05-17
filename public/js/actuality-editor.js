tinymce.init({
	selector: "#actuality_content",
	height: 500,
	language: "fr_FR",
	plugins: [
		"lists",
		"table",
		"link",
		"preview",
	],
	menubar: false,
	toolbar: `
		undo redo |
		blocks fontfamily fontsize |
		bold italic underline strikethrough forecolor backcolor |
		alignleft aligncenter alignright alignjustify |
		bullist numlist indent outdent |
		table link |
		preview misc
	`,
	setup: editor => {
		// Dismiss the editor status bar
		editor.on("init", () => document.querySelector(".tox-statusbar").remove());

		// Save new content
		editor.on("change", function() {this.save()});
	},
});