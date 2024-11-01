import React from 'react';
import { RichText, MediaUpload } from '@wordpress/block-editor';
import { TextControl, Button, RangeControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

const TestimonialList = ({
                             testimonials,
                             setTestimonialList,
                             deleteTestimonial,
                             showImage,
                             imageSize,
                             imageRounded,
                             imageAlign,
                         }) => (
    <>
        {testimonials.map((testimonial, index) => (
            <div key={testimonial.id || index} className={`testimonial-item ${imageAlign}`}>
                <MediaUpload
                    onSelect={(media) => {
                        const newTestimonialList = [...testimonials];
                        newTestimonialList[index].image_url = media.url;
                        setTestimonialList(newTestimonialList);
                    }}
                    allowedTypes={['image']}
                    value={testimonial.image_url}
                    render={({ open }) => (
                        <Button onClick={open}>
                            {__('Upload Image', 'testimonials-for-everyone')}
                        </Button>
                    )}
                />
                {testimonial.image_url && (
                    <img
                        src={testimonial.image_url}
                        alt={testimonial.author}
                        style={{ maxWidth: '100%', height: 'auto' }}
                    />
                )}
                <TextControl
                    label={__('Author', 'testimonials-for-everyone')}
                    value={testimonial.author}
                    onChange={(value) => {
                        const newTestimonialList = [...testimonials];
                        newTestimonialList[index].author = value;
                        setTestimonialList(newTestimonialList);
                    }}
                />
                <TextControl
                    label={__('Company', 'testimonials-for-everyone')}
                    value={testimonial.company}
                    onChange={(value) => {
                        const newTestimonialList = [...testimonials];
                        newTestimonialList[index].company = value;
                        setTestimonialList(newTestimonialList);
                    }}
                />
                <RichText
                    tagName="p"
                    value={testimonial.content}
                    onChange={(value) => {
                        const newTestimonialList = [...testimonials];
                        newTestimonialList[index].content = value;
                        setTestimonialList(newTestimonialList);
                    }}
                    placeholder={__('Add testimonial content...', 'testimonials-for-everyone')}
                />
                <TextControl
                    label={__('Website Link', 'testimonials-for-everyone')}
                    value={testimonial.link}
                    onChange={(value) => {
                        const newTestimonialList = [...testimonials];
                        newTestimonialList[index].link = value;
                        setTestimonialList(newTestimonialList);
                    }}
                />
                <RangeControl
                    label={__('Rating', 'testimonials-for-everyone')}
                    value={testimonial.rating}
                    onChange={(value) => {
                        const newTestimonialList = [...testimonials];
                        newTestimonialList[index].rating = value;
                        setTestimonialList(newTestimonialList);
                    }}
                    min={1}
                    max={5}
                />
                <Button
                    isDestructive
                    onClick={() => deleteTestimonial(testimonial.id, index)}
                >
                    {__('Delete', 'testimonials-for-everyone')}
                </Button>
            </div>
        ))}
    </>
);

export default TestimonialList;
