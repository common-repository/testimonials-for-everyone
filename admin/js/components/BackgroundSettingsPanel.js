import React from 'react';
import { PanelBody, RangeControl, ColorPicker } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

const BackgroundSettingsPanel = ({ attributes, setAttributes, activeTab, handlePanelClick }) => {
    const {
        backgroundColor,
        borderSize,
        borderColor,
        borderRadius
    } = attributes;

    return (
        <PanelBody
            initialOpen={false}
            title={__('Background Styling', 'testimonials-for-everyone')}
            onToggle={() => handlePanelClick('background')}
            style={{
                borderBottom: activeTab === 'background' ? '2px solid #007cba' : 'none',
            }}
        >
            <span>{__('BACKGROUND COLOR', 'testimonials-for-everyone')}</span>
            <ColorPicker
                label={__('Background Color', 'testimonials-for-everyone')}
                color={backgroundColor}
                onChange={(value) => setAttributes({backgroundColor: value})}
            />
            <hr/>
            <span>{__('BORDER COLOR', 'testimonials-for-everyone')}</span>
            <ColorPicker
                label={__('Border Color', 'testimonials-for-everyone')}
                color={borderColor}
                onChange={(value) => setAttributes({borderColor: value})}
            />
            <hr/>
            <RangeControl
                label={__('Border Size', 'testimonials-for-everyone')}
                value={borderSize}
                onChange={(value) => setAttributes({borderSize: value})}
                min={0}
                max={20}
            />
            <hr/>
            <RangeControl
                label={__('Rounded Border Corners', 'wp-testimonials-for-everyone')}
                value={borderRadius}
                onChange={(value) => setAttributes({borderRadius: value})}
                min={0}
                max={20}
            />
        </PanelBody>
    );
};

export default BackgroundSettingsPanel;
