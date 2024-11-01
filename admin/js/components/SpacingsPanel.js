import React from 'react';
import {PanelBody, ColorPicker, RangeControl, SelectControl} from '@wordpress/components';
import { __ } from '@wordpress/i18n';

const SpacingsPanel = ({ attributes, setAttributes, activeTab, handlePanelClick }) => {
    const {
        paddingTop,
        paddingBottom,
        paddingLeft,
        paddingRight
    } = attributes;

    return (
        <PanelBody
            initialOpen={false}
            title={__('Spacings', 'testimonials-for-everyone')}
            onToggle={() => handlePanelClick('spacings')}
            style={{
                borderBottom: activeTab === 'spacings' ? '2px solid #007cba' : 'none',
            }}
        >
            <RangeControl
                label={__('Padding Top', 'testimonials-for-everyone')}
                value={paddingTop}
                onChange={(value) => setAttributes({paddingTop: value})}
                min={0}
                max={100}
            />
            <hr/>
            <RangeControl
                label={__('Padding Bottom', 'testimonials-for-everyone')}
                value={paddingBottom}
                onChange={(value) => setAttributes({paddingBottom: value})}
                min={0}
                max={100}
            />
            <hr/>
            <RangeControl
                label={__('Padding Left', 'testimonials-for-everyone')}
                value={paddingLeft}
                onChange={(value) => setAttributes({paddingLeft: value})}
                min={0}
                max={100}
            />
            <hr/>
            <RangeControl
                label={__('Padding Right', 'testimonials-for-everyone')}
                value={paddingRight}
                onChange={(value) => setAttributes({paddingRight: value})}
                min={0}
                max={100}
            />
        </PanelBody>
    );
};

export default SpacingsPanel;
