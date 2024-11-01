<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wppforeveryone.com
 * @since      1.0.0
 *
 * @package    Wppfe
 * @subpackage Wppfe_Testimonials_For_Everyone/admin/partials
 */

?>

<div class="wrap max-w-5xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-8 text-center"><?php
		esc_html_e( 'Testimonials Plugin Help & Tutorials', 'testimonials-for-everyone' ); ?></h1>
    <br>
    <!-- Tabs Navigation -->
    <div id="tabs" class="tabs-container mb-8">
        <ul class="flex justify-center space-x-4 border-b-2 border-gray-200">
            <li>
                <a class="tab-link active bg-gray-100 py-2 px-6 font-bold text-gray-800 rounded-t-lg transition ease-in-out duration-200"
                   href="#settings-tab">
					<?php esc_html_e( 'Settings', 'testimonials-for-everyone' ); ?>
                </a>
            </li>
            <li>
                <a class="tab-link bg-white py-2 px-6 font-bold text-gray-600 hover:bg-gray-100 hover:text-gray-800 rounded-t-lg transition ease-in-out duration-200"
                   href="#manage-testimonials-tab">
					<?php esc_html_e( 'Manage Testimonials', 'testimonials-for-everyone' ); ?>
                </a>
            </li>
            <li>
                <a class="tab-link bg-white py-2 px-6 font-bold text-gray-600 hover:bg-gray-100 hover:text-gray-800 rounded-t-lg transition ease-in-out duration-200"
                   href="#tutorial-tab">
					<?php esc_html_e( 'Tutorial', 'testimonials-for-everyone' ); ?>
                </a>
            </li>
        </ul>
    </div>

    <div id="settings-tab" class="tab-content">
        <div class="bg-gray-50 p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4 text-gray-700"><?php esc_html_e( 'Settings', 'testimonials-for-everyone' ); ?></h2>
            <p class="text-gray-600 mb-4"><?php esc_html_e( 'In the Gutenberg block section of the Testimonials for Everyone plugin, you will find three dropdown menus to help you customize your testimonials. These dropdowns are:', 'testimonials-for-everyone' ); ?></p>

            <h3 class="text-xl font-semibold text-gray-700 mb-2"><?php esc_html_e( 'Settings', 'testimonials-for-everyone' ); ?></h3>
            <p class="text-gray-600 mb-4"><?php esc_html_e( 'Under the "Settings" dropdown, you will find various options to control the alignment and display of the testimonial content. You can:', 'testimonials-for-everyone' ); ?></p>
            <ul class="list-disc list-inside text-gray-700 mb-6">
                <li><?php esc_html_e( 'Adjust the content alignment (left, center, right).', 'testimonials-for-everyone' ); ?></li>
                <li><?php esc_html_e( 'Enable or disable the author image display.', 'testimonials-for-everyone' ); ?></li>
                <li><?php esc_html_e( 'Make the author image round or keep its original corners.', 'testimonials-for-everyone' ); ?></li>
                <li><?php esc_html_e( 'Change the review stars size to fit your design.', 'testimonials-for-everyone' ); ?></li>
                <li><?php esc_html_e( 'Adjust the alignment of the review stars within the testimonial.', 'testimonials-for-everyone' ); ?></li>
            </ul>

            <h3 class="text-xl font-semibold text-gray-700 mb-2"><?php esc_html_e( 'Background Settings', 'testimonials-for-everyone' ); ?></h3>
            <p class="text-gray-600 mb-4"><?php esc_html_e( 'In the "Background Settings" dropdown, you can customize the appearance of the testimonial background and border. The options include:', 'testimonials-for-everyone' ); ?></p>
            <ul class="list-disc list-inside text-gray-700 mb-6">
                <li><?php esc_html_e( 'Change the background color of the testimonial block.', 'testimonials-for-everyone' ); ?></li>
                <li><?php esc_html_e( 'Set the size of the border around the testimonial.', 'testimonials-for-everyone' ); ?></li>
                <li><?php esc_html_e( 'Adjust the border radius for rounded or sharp edges.', 'testimonials-for-everyone' ); ?></li>
                <li><?php esc_html_e( 'Change the border color to match your theme.', 'testimonials-for-everyone' ); ?></li>
            </ul>

            <h3 class="text-xl font-semibold text-gray-700 mb-2"><?php esc_html_e( 'Styling', 'testimonials-for-everyone' ); ?></h3>
            <p class="text-gray-600 mb-4"><?php esc_html_e( 'The "Styling" dropdown allows you to personalize the colors of different parts of the testimonial text. Here you can:', 'testimonials-for-everyone' ); ?></p>
            <ul class="list-disc list-inside text-gray-700 mb-6">
                <li><?php esc_html_e( 'Change the text color of the testimonial author name.', 'testimonials-for-everyone' ); ?></li>
                <li><?php esc_html_e( 'Customize the text color for the company name of the testimonial author.', 'testimonials-for-everyone' ); ?></li>
                <li><?php esc_html_e( 'Set the color of the main testimonial content text.', 'testimonials-for-everyone' ); ?></li>
            </ul>

            <p class="text-gray-600"><?php esc_html_e( 'These options provide a flexible and easy way to customize the look and feel of the testimonials on your website to ensure they fit seamlessly with your design.', 'testimonials-for-everyone' ); ?></p>
        </div>
    </div>


    <div id="manage-testimonials-tab" class="tab-content hidden">
        <div class="bg-gray-50 p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4 text-gray-700"><?php esc_html_e( 'Manage Testimonials', 'testimonials-for-everyone' ); ?></h2>
            <p class="text-gray-600 mb-4"><?php esc_html_e( 'In the "Manage Testimonials" section, you can easily add, edit, and arrange your testimonials. The following features will help you manage each testimonial efficiently:', 'testimonials-for-everyone' ); ?></p>

            <h3 class="text-xl font-semibold text-gray-700 mb-2"><?php esc_html_e( 'Change Testimonial Order', 'testimonials-for-everyone' ); ?></h3>
            <p class="text-gray-600 mb-4"><?php esc_html_e( 'You can change the display order of your testimonials to highlight certain ones. To adjust the order:', 'testimonials-for-everyone' ); ?></p>
            <ul class="list-disc list-inside text-gray-700 mb-6">
                <li><?php esc_html_e( 'Drag and drop testimonials to rearrange them in the order you prefer.', 'testimonials-for-everyone' ); ?></li>
            </ul>

            <h3 class="text-xl font-semibold text-gray-700 mb-2"><?php esc_html_e( 'Upload Testimonial Author Image', 'testimonials-for-everyone' ); ?></h3>
            <p class="text-gray-600 mb-4"><?php esc_html_e( 'To personalize each testimonial, you can upload an image of the testimonial author:', 'testimonials-for-everyone' ); ?></p>
            <ul class="list-disc list-inside text-gray-700 mb-6">
                <li><?php esc_html_e( 'Click the "Upload Image" button to select an image from your media library or upload a new one.', 'testimonials-for-everyone' ); ?></li>
                <li><?php esc_html_e( 'The author image will be displayed alongside the testimonial content if the "Show Image" option is enabled in the settings.', 'testimonials-for-everyone' ); ?></li>
            </ul>

            <h3 class="text-xl font-semibold text-gray-700 mb-2"><?php esc_html_e( 'Author Name and Company Name', 'testimonials-for-everyone' ); ?></h3>
            <p class="text-gray-600 mb-4"><?php esc_html_e( 'For each testimonial, you can enter the name of the person giving the testimonial and their company name:', 'testimonials-for-everyone' ); ?></p>
            <ul class="list-disc list-inside text-gray-700 mb-6">
                <li><?php esc_html_e( 'Enter the testimonial author’s full name in the "Author Name" field.', 'testimonials-for-everyone' ); ?></li>
                <li><?php esc_html_e( 'Optionally, you can add the company name where the author works in the "Company Name" field.', 'testimonials-for-everyone' ); ?></li>
            </ul>

            <h3 class="text-xl font-semibold text-gray-700 mb-2"><?php esc_html_e( 'Star Rating', 'testimonials-for-everyone' ); ?></h3>
            <p class="text-gray-600 mb-4"><?php esc_html_e( 'You can set a star rating for each testimonial to reflect the feedback score. To set the star rating:', 'testimonials-for-everyone' ); ?></p>
            <ul class="list-disc list-inside text-gray-700 mb-6">
                <li><?php esc_html_e( 'Choose the number of stars (from 1 to 5) for each testimonial in the "Star Rating" field.', 'testimonials-for-everyone' ); ?></li>
                <li><?php esc_html_e( 'The star rating will be displayed next to the testimonial, providing a visual indication of the feedback score.', 'testimonials-for-everyone' ); ?></li>
            </ul>

            <h3 class="text-xl font-semibold text-gray-700 mb-2"><?php esc_html_e( 'Main Testimonial Content', 'testimonials-for-everyone' ); ?></h3>
            <p class="text-gray-600 mb-4"><?php esc_html_e( 'The most important part of each testimonial is the main content, which contains the customer feedback. To add or edit the testimonial content:', 'testimonials-for-everyone' ); ?></p>
            <ul class="list-disc list-inside text-gray-700 mb-6">
                <li><?php esc_html_e( 'Enter the feedback or testimonial text in the "Content" field.', 'testimonials-for-everyone' ); ?></li>
                <li><?php esc_html_e( 'You can add a short paragraph or multiple sentences based on the feedback received.', 'testimonials-for-everyone' ); ?></li>
            </ul>

            <p class="text-gray-600"><?php esc_html_e( 'Managing your testimonials is easy and intuitive with these tools, ensuring your testimonials always look professional and are presented in the best possible way.', 'testimonials-for-everyone' ); ?></p>
        </div>
    </div>


    <div id="tutorial-tab" class="tab-content hidden">
        <div class="bg-gray-50 p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mt-4 mb-2 text-gray-700"><?php
				esc_html_e( 'Step 1: Install and Activate the Plugin', 'testimonials-for-everyone' ); ?></h3>
            <p class="text-gray-600"><?php
				esc_html_e( 'To install the plugin, follow these steps:', 'testimonials-for-everyone' ); ?></p>
            <ol class="list-decimal list-inside text-gray-700">
                <li><?php
					esc_html_e( 'Log into your WordPress dashboard.', 'testimonials-for-everyone' ); ?></li>
                <li><?php
					esc_html_e( 'Go to "Plugins" > "Add New".', 'testimonials-for-everyone' ); ?></li>
                <li><?php
					esc_html_e( 'In the search bar, type "Testimonials for Everyone".',
						'testimonials-for-everyone' ); ?></li>
                <li><?php
					esc_html_e( 'Click "Install Now" and then "Activate".', 'testimonials-for-everyone' ); ?></li>
            </ol>
            <p class="text-gray-500 italic"><?php
				esc_html_e( 'Image: Plugin installation screen', 'testimonials-for-everyone' ); ?></p>
            <!-- Insert image of the WordPress plugin installation screen here -->

            <h3 class="text-xl font-semibold mt-4 mb-2 text-gray-700"><?php
				esc_html_e( 'Step 2: Create a New Page or Post', 'testimonials-for-everyone' ); ?></h3>
            <p class="text-gray-600"><?php
				esc_html_e( 'Now, you can add a testimonials block to any page or post on your site.',
					'testimonials-for-everyone' ); ?></p>
            <ol class="list-decimal list-inside text-gray-700">
                <li><?php
					esc_html_e( 'Go to "Pages" or "Posts" and click "Add New".', 'testimonials-for-everyone' ); ?></li>
                <li><?php
					esc_html_e( 'In the Gutenberg block editor, click the "+" button to add a block.',
						'testimonials-for-everyone' ); ?></li>
                <li><?php
					esc_html_e( 'In the search bar, type "Testimonials for Everyone".',
						'testimonials-for-everyone' ); ?></li>
                <li><?php
					esc_html_e( 'Click on the "Testimonials for Everyone" block to add it to your post or page.',
						'testimonials-for-everyone' ); ?></li>
            </ol>
            <p class="text-gray-500 italic"><?php
				esc_html_e( 'Image: Adding the testimonials block in Gutenberg', 'testimonials-for-everyone' ); ?></p>
            <!-- Insert image of adding a block in Gutenberg here -->

            <h3 class="text-xl font-semibold mt-4 mb-2 text-gray-700"><?php
				esc_html_e( 'Step 3: Customize Your Testimonials Block', 'testimonials-for-everyone' ); ?></h3>
            <p class="text-gray-600"><?php
				esc_html_e( 'After adding the testimonials block, you can customize its layout and appearance:',
					'testimonials-for-everyone' ); ?></p>
            <ol class="list-decimal list-inside text-gray-700">
                <li><?php
					esc_html_e( 'Select the testimonials block on the page.', 'testimonials-for-everyone' ); ?></li>
                <li><?php
					esc_html_e( 'In the right-hand panel, customize options like the number of columns, background color, and border style.',
						'testimonials-for-everyone' ); ?></li>
                <li><?php
					esc_html_e( 'You can also enable or disable features like company name, rating, and author image.',
						'testimonials-for-everyone' ); ?></li>
            </ol>
            <p class="text-gray-500 italic"><?php
				esc_html_e( 'Image: Customizing the testimonials block in the Gutenberg editor',
					'testimonials-for-everyone' ); ?></p>
            <!-- Insert image of customizing the block in Gutenberg here -->

            <h3 class="text-xl font-semibold mt-4 mb-2 text-gray-700"><?php
				esc_html_e( 'Step 4: Add Testimonials to Your Site', 'testimonials-for-everyone' ); ?></h3>
            <p class="text-gray-600"><?php
				esc_html_e( 'You can now add your customer testimonials:', 'testimonials-for-everyone' ); ?></p>
            <ol class="list-decimal list-inside text-gray-700">
                <li><?php
					esc_html_e( 'Click inside the block and add the name of the person giving the testimonial.',
						'testimonials-for-everyone' ); ?></li>
                <li><?php
					esc_html_e( 'You can also add a short description, such as the company name and position.',
						'testimonials-for-everyone' ); ?></li>
                <li><?php
					esc_html_e( 'Write their testimonial content, including their feedback or review.',
						'testimonials-for-everyone' ); ?></li>
                <li><?php
					esc_html_e( 'If applicable, you can add an image of the person by enabling the "Show Image" option.',
						'testimonials-for-everyone' ); ?></li>
                <li><?php
					esc_html_e( 'Finally, set the rating by enabling the "Show Rating" option and selecting a star rating.',
						'testimonials-for-everyone' ); ?></li>
            </ol>
            <p class="text-gray-500 italic"><?php
				esc_html_e( 'Image: Adding testimonial content and customizing layout',
					'testimonials-for-everyone' ); ?></p>
            <!-- Insert image of adding testimonial content here -->

            <h3 class="text-xl font-semibold mt-4 mb-2 text-gray-700"><?php
				esc_html_e( 'Step 5: Publish the Page or Post', 'testimonials-for-everyone' ); ?></h3>
            <p class="text-gray-600"><?php
				esc_html_e( 'Once you’re happy with how the testimonials look, publish the page or post:',
					'testimonials-for-everyone' ); ?></p>
            <ol class="list-decimal list-inside text-gray-700">
                <li><?php
					esc_html_e( 'Click the "Publish" button in the top-right corner of the editor.',
						'testimonials-for-everyone' ); ?></li>
                <li><?php
					esc_html_e( 'The testimonials will now be visible on your site.',
						'testimonials-for-everyone' ); ?></li>
            </ol>
            <p class="text-gray-500 italic"><?php
				esc_html_e( 'Image: Publishing the page or post with testimonials',
					'testimonials-for-everyone' ); ?></p>
            <!-- Insert image of publishing the page or post here -->

            <h3 class="text-xl font-semibold mt-4 mb-2 text-gray-700"><?php
				esc_html_e( 'Step 6: Managing Testimonials', 'testimonials-for-everyone' ); ?></h3>
            <p class="text-gray-600"><?php
				esc_html_e( 'If you need to update or delete testimonials:', 'testimonials-for-everyone' ); ?></p>
            <ol class="list-decimal list-inside text-gray-700">
                <li><?php
					esc_html_e( 'Go to the page or post containing the testimonials.',
						'testimonials-for-everyone' ); ?></li>
                <li><?php
					esc_html_e( 'Click the testimonials block and edit the testimonial text, rating, or image as needed.',
						'testimonials-for-everyone' ); ?></li>
                <li><?php
					esc_html_e( 'To remove a testimonial, delete the corresponding block or individual entry.',
						'testimonials-for-everyone' ); ?></li>
            </ol>
            <p class="text-gray-500 italic"><?php
				esc_html_e( 'Image: Managing and editing testimonials in Gutenberg',
					'testimonials-for-everyone' ); ?></p>
            <!-- Insert image of managing testimonials here -->

            <p class="mt-6 text-gray-600"><?php
				esc_html_e( 'That’s it! You’ve now successfully added and customized testimonials on your WordPress site using the "Testimonials for Everyone" plugin.',
					'testimonials-for-everyone' ); ?></p>
        </div>
    </div>
</div>
