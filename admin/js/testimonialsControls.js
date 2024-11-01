import React from 'react';
import { PanelBody, ToggleControl, RangeControl, SelectControl, ColorPicker } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

const TestimonialsControls = ({
                                  showImage,
                                  imageSize,
                                  imageRounded,
                                  imageAlign,
                                  showCompany,
                                  showLink,
                                  showRating,
                                  rating,
                                  starColor,
                                  starSize,
                                  setAttributes,
                              }) => (
    <PanelBody title={__('Settings', 'testimonials-for-everyone')}>
        <ToggleControl
            label={__('Show Image', 'testimonials-for-everyone')}
            checked={showImage}
            onChange={(value) => setAttributes({ showImage: value })}
        />
        {showImage && (
            <>
                <RangeControl
                    label={__('Image Size', 'testimonials-for-everyone')}
                    value={imageSize}
                    onChange={(value) => setAttributes({ imageSize: value })}
                    min={50}
                    max={200}
                />
                <ToggleControl
                    label={__('Rounded Corners', 'testimonials-for-everyone')}
                    checked={imageRounded}
                    onChange={(value) => setAttributes({ imageRounded: value })}
                />
                <SelectControl
                    label={__('Image Alignment', 'testimonials-for-everyone')}
                    value={imageAlign}
                    options={[
                        { label: __('Left', 'testimonials-for-everyone'), value: 'left' },
                        { label: __('Center', 'testimonials-for-everyone'), value: 'center' },
                        { label: __('Right', 'testimonials-for-everyone'), value: 'right' },
                    ]}
                    onChange={(value) => setAttributes({ imageAlign: value })}
                />
            </>
        )}
        <ToggleControl
            label={__('Show Company', 'testimonials-for-everyone')}
            checked={showCompany}
            onChange={(value) => setAttributes({ showCompany: value })}
        />
        <ToggleControl
            label={__('Show Link', 'testimonials-for-everyone')}
            checked={showLink}
            onChange={(value) => setAttributes({ showLink: value })}
        />
        <ToggleControl
            label={__('Show Rating', 'testimonials-for-everyone')}
            checked={showRating}
            onChange={(value) => setAttributes({ showRating: value })}
        />
        {showRating && (
            <>
                <RangeControl
                    label={__('Rating', 'testimonials-for-everyone')}
                    value={rating}
                    onChange={(value) => setAttributes({ rating: value })}
                    min={1}
                    max={5}
                />
                <ColorPicker
                    label={__('Star Color', 'testimonials-for-everyone')}
                    color={starColor}
                    onChange={(value) => setAttributes({ starColor: value })}
                />
                <RangeControl
                    label={__('Star Size', 'testimonials-for-everyone')}
                    value={starSize}
                    onChange={(value) => setAttributes({ starSize: value })}
                    min={10}
                    max={50}
                />
            </>
        )}
    </PanelBody>
);

export default TestimonialsControls;
