(function( $ ) {
	'use strict';

	document.addEventListener("DOMContentLoaded", function () {

		$('.grid').masonry({
			itemSelector: '.testimonial',
			columnWidth: 200
		});

		const tabs = document.querySelectorAll('.tab-link');
		const tabContents = document.querySelectorAll('.tab-content');

		// Default active tab
		tabContents.forEach(content => content.classList.add('hidden'));
		document.querySelector("#settings-tab").classList.remove('hidden');

		tabs.forEach(tab => {
			tab.addEventListener('click', function (e) {
				e.preventDefault();

				// Remove active class from all tabs
				tabs.forEach(t => t.classList.remove('bg-gray-100', 'text-gray-800', 'active'));
				tabContents.forEach(content => content.classList.add('hidden')); // Hide all tab contents

				// Add active class to clicked tab
				this.classList.add('bg-gray-100', 'text-gray-800', 'active');

				// Show the corresponding content
				const target = this.getAttribute('href');
				document.querySelector(target).classList.remove('hidden');
			});
		});

	});


})( jQuery );
