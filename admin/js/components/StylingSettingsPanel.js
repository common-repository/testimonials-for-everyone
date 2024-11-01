import React from 'react';
import {PanelBody, ColorPicker, RangeControl, SelectControl} from '@wordpress/components';
import { __ } from '@wordpress/i18n';

const StylingSettingsPanel = ({ attributes, setAttributes, activeTab, handlePanelClick }) => {
    const {
        authorColor,
        companyColor,
        contentColor,
        authorFontSize,
        companyFontSize,
        testimonialFontSize,
        authorFontWeight,
        companyFontWeight,
        testimonialFontWeight,
    } = attributes;

    return (
        <PanelBody
            initialOpen={false}
            title={__('Content Styling', 'testimonials-for-everyone')}
            onToggle={() => handlePanelClick('styling')}
            style={{
                borderBottom: activeTab === 'styling' ? '2px solid #007cba' : 'none',
            }}
        >
            <strong style={{marginBottom: "10px"}}>{__('AUTHOR TEXT COLOR', 'testimonials-for-everyone')}</strong>
            <ColorPicker
                color={authorColor}
                onChange={(value) => setAttributes({authorColor: value})}
            />
            <hr/>
            <strong style={{marginBottom: "10px"}}>{__('COMPANY TEXT COLOR', 'testimonials-for-everyone')}</strong>
            <ColorPicker
                color={companyColor}
                onChange={(value) => setAttributes({companyColor: value})}
            />
            <hr/>
            <strong style={{marginBottom: "10px"}}>{__('MAIN CONTENT COLOR', 'testimonials-for-everyone')}</strong>
            <ColorPicker
                label={__('Content Text Color', 'testimonials-for-everyone')}
                color={contentColor}
                onChange={(value) => setAttributes({contentColor: value})}
            />
            <hr/>
            <RangeControl
                label={__('AUTHOR FONT SIZE', 'testimonials-for-everyone')}
                value={authorFontSize}
                onChange={(value) => setAttributes({authorFontSize: value})}
                min={5}
                max={30}
            />
            <hr/>
            <RangeControl
                label={__('COMPANY FONT SIZE', 'testimonials-for-everyone')}
                value={companyFontSize}
                onChange={(value) => setAttributes({companyFontSize: value})}
                min={5}
                max={30}
            />
            <hr/>
            <RangeControl
                label={__('TESTIMONIAL FONT SIZE', 'testimonials-for-everyone')}
                value={testimonialFontSize}
                onChange={(value) => setAttributes({testimonialFontSize: value})}
                min={5}
                max={30}
            />
            <hr/>
            <SelectControl
                label={__('Author Font Weight', 'testimonials-for-everyone')}
                value={authorFontWeight}
                options={[
                    {label: __('100 - Thin', 'testimonials-for-everyone'), value: '100'},
                    {label: __('400 - Normal', 'testimonials-for-everyone'), value: '400'},
                    {label: __('500 - Medium', 'testimonials-for-everyone'), value: '500'},
                    {label: __('700 - Bold', 'testimonials-for-everyone'), value: '700'},
                ]}
                onChange={(value) => setAttributes({authorFontWeight: value})}
            />
            <hr/>
            <SelectControl
                label={__('Company Font Weight', 'testimonials-for-everyone')}
                value={companyFontWeight}
                options={[
                    {label: __('100 - Thin', 'testimonials-for-everyone'), value: '100'},
                    {label: __('400 - Normal', 'testimonials-for-everyone'), value: '400'},
                    {label: __('500 - Medium', 'testimonials-for-everyone'), value: '500'},
                    {label: __('700 - Bold', 'testimonials-for-everyone'), value: '700'},
                ]}
                onChange={(value) => setAttributes({companyFontWeight: value})}
            />
            <hr/>
            <SelectControl
                label={__('Testimonial Font Weight', 'testimonials-for-everyone')}
                value={testimonialFontWeight}
                options={[
                    {label: __('100 - Thin', 'testimonials-for-everyone'), value: '100'},
                    {label: __('400 - Normal', 'testimonials-for-everyone'), value: '400'},
                    {label: __('500 - Medium', 'testimonials-for-everyone'), value: '500'},
                    {label: __('700 - Bold', 'testimonials-for-everyone'), value: '700'},
                ]}
                onChange={(value) => setAttributes({testimonialFontWeight: value})}
            />
        </PanelBody>
    );
};

export default StylingSettingsPanel;
