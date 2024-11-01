import {registerBlockType} from '@wordpress/blocks';
import {__} from '@wordpress/i18n';
import Edit from './edit';
import Save from './save';

registerBlockType('wp-testimonials-for-everyone/testimonial', {
    title: __('Testimonials For Everyone', 'testimonials-for-everyone'),
    icon: 'admin-comments',
    category: 'widgets',
    keywords: [
        __('Testimonials', 'testimonials-for-everyone'),
        __('Reviews', 'testimonials-for-everyone'),
        __('For Everyone', 'testimonials-for-everyone'),
    ],
    attributes: {
        content: {
            type: 'string',
            source: 'html',
            selector: 'p',
        },
        author: {
            type: 'string',
            source: 'text',
            selector: '.author',
        },
        company: {
            type: 'string',
            source: 'text',
            selector: '.company',
        },
        link: {
            type: 'string',
            source: 'attribute',
            attribute: 'href',
            selector: '.website-link',
        },
        rating: {
            type: 'number',
            default: 5,
        },
        starColor: {
            type: 'string',
            default: '#ffcc00',
        },
        authorColor: {
            type: 'string',
            default: '#222222',
        },
        companyColor: {
            type: 'string',
            default: '#222222',
        },
        contentColor: {
            type: 'string',
            default: '#222222',
        },
        paddingTop: {
            type: 'number',
            default: 15,
        },
        paddingBottom: {
            type: 'number',
            default: 15,
        },
        paddingLeft: {
            type: 'number',
            default: 15,
        },
        paddingRight: {
            type: 'number',
            default: 15,
        },
        starSize: {
            type: 'number',
            default: 20,
        },
        authorFontSize: {
            type: 'number',
            default: 20
        },
        companyFontSize: {
            type: 'number',
            default: 15
        },
        testimonialFontSize: {
            type: 'number',
            default: 22
        },
        authorFontWeight: {
            type: 'number',
            default: 400
        },
        companyFontWeight: {
            type: 'number',
            default: 400
        },
        testimonialFontWeight: {
            type: 'number',
            default: 400
        },
        starAligment: {
            type: 'string',
            default: 'left',
        },
        showImage: {
            type: 'boolean',
            default: true,
        },
        showCompany: {
            type: 'boolean',
            default: true,
        },
        showLink: {
            type: 'boolean',
            default: true,
        },
        showRating: {
            type: 'boolean',
            default: true,
        },
        image_url: {
            type: 'string',
            default: '',
        },
        imageSize: {
            type: 'number',
            default: 100,
        },
        imageRounded: {
            type: 'boolean',
            default: false,
        },
        imageAlign: {
            type: 'string',
            default: 'left',
        },
        authorAlign: {
            type: 'string',
            default: 'left',
        },
        companyAlign: {
            type: 'string',
            default: 'left',
        },
        testimonialsLayout: {
            type: 'string',
            default: 'standard'
        },
        contentAlign: {
            type: 'string',
            default: 'left',
        },
        backgroundColor: {
            type: 'string',
            default: '#ffffff',
        },
        borderSize: {
            type: 'number',
            default: 1,
        },
        testimonialsNumberInGrid: {
            type: 'number',
            default: 2
        },
        borderColor: {
            type: 'string',
            default: '#000000',
        },
        borderRadius: {
            type: 'number',
            default: 0,
        },
    },
    edit: Edit,
    save: Save,
});