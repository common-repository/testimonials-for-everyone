import React from 'react';
import { PanelBody, ToggleControl, RangeControl, SelectControl, ColorPicker } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

const SettingsPanel = ({ attributes, setAttributes, activeTab, handlePanelClick }) => {
    const {
        showImage,
        imageSize,
        imageRounded,
        imageAlign,
        authorAlign,
        companyAlign,
        contentAlign,
        showCompany,
        showRating,
        starColor,
        starSize,
        starAligment,
    } = attributes;

    return (
        <PanelBody
            initialOpen={false}
            title={__('Settings', 'testimonials-for-everyone')}
            onToggle={() => handlePanelClick('settings')}
            style={{
                borderBottom: activeTab === 'settings' ? '2px solid #007cba' : 'none',
            }}
        >
            <SelectControl
                label={__('Author Alignment', 'testimonials-for-everyone')}
                value={authorAlign}
                options={[
                    { label: __('Left', 'testimonials-for-everyone'), value: 'left' },
                    { label: __('Center', 'testimonials-for-everyone'), value: 'center' },
                    { label: __('Right', 'testimonials-for-everyone'), value: 'right' },
                ]}
                onChange={(value) => setAttributes({ authorAlign: value })}
            />
            <SelectControl
                label={__('Company Alignment', 'testimonials-for-everyone')}
                value={companyAlign}
                options={[
                    { label: __('Left', 'testimonials-for-everyone'), value: 'left' },
                    { label: __('Center', 'testimonials-for-everyone'), value: 'center' },
                    { label: __('Right', 'testimonials-for-everyone'), value: 'right' },
                ]}
                onChange={(value) => setAttributes({ companyAlign: value })}
            />
            <SelectControl
                label={__('Content Alignment', 'testimonials-for-everyone')}
                value={contentAlign}
                options={[
                    { label: __('Left', 'testimonials-for-everyone'), value: 'left' },
                    { label: __('Center', 'testimonials-for-everyone'), value: 'center' },
                    { label: __('Right', 'testimonials-for-everyone'), value: 'right' },
                ]}
                onChange={(value) => setAttributes({ contentAlign: value })}
            />
            <ToggleControl
                label={__('Show Image', 'wp-testimonials-for-everyone')}
                checked={showImage}
                onChange={(value) => setAttributes({ showImage: value })}
            />
            {showImage && (
                <>
                    <RangeControl
                        label={__('Image Size', 'wp-testimonials-for-everyone')}
                        value={imageSize}
                        onChange={(value) => setAttributes({ imageSize: value })}
                        min={50}
                        max={200}
                    />
                    <ToggleControl
                        label={__('Rounded Corners', 'wp-testimonials-for-everyone')}
                        checked={imageRounded}
                        onChange={(value) => setAttributes({ imageRounded: value })}
                    />
                    <SelectControl
                        label={__('Image Alignment', 'wp-testimonials-for-everyone')}
                        value={imageAlign}
                        options={[
                            { label: __('Left', 'wp-testimonials-for-everyone'), value: 'left' },
                            { label: __('Center', 'wp-testimonials-for-everyone'), value: 'center' },
                            { label: __('Right', 'wp-testimonials-for-everyone'), value: 'right' },
                        ]}
                        onChange={(value) => setAttributes({ imageAlign: value })}
                    />
                </>
            )}
            <ToggleControl
                label={__('Show Company', 'wp-testimonials-for-everyone')}
                checked={showCompany}
                onChange={(value) => setAttributes({ showCompany: value })}
            />
            <ToggleControl
                label={__('Show Rating', 'wp-testimonials-for-everyone')}
                checked={showRating}
                onChange={(value) => setAttributes({ showRating: value })}
            />
            {showRating && (
                <>
                    <ColorPicker
                        label={__('Star Color', 'wp-testimonials-for-everyone')}
                        color={starColor}
                        onChange={(value) => setAttributes({ starColor: value })}
                    />
                    <RangeControl
                        label={__('Star Size', 'wp-testimonials-for-everyone')}
                        value={starSize}
                        onChange={(value) => setAttributes({ starSize: value })}
                        min={10}
                        max={50}
                    />
                    <SelectControl
                        label={__('Stars Alignment', 'wp-testimonials-for-everyone')}
                        value={starAligment}
                        options={[
                            { label: __('Left', 'wp-testimonials-for-everyone'), value: 'left' },
                            { label: __('Center', 'wp-testimonials-for-everyone'), value: 'center' },
                            { label: __('Right', 'wp-testimonials-for-everyone'), value: 'right' },
                        ]}
                        onChange={(value) => setAttributes({ starAligment: value })}
                    />
                </>
            )}
        </PanelBody>
    );
};

export default SettingsPanel;
