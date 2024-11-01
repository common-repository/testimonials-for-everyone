import React, {useState} from 'react';
import {__} from "@wordpress/i18n";
import {PanelBody, ColorPicker, RangeControl, SelectControl} from '@wordpress/components';

const ShortcodePanel = ({attributes, activeTab, handlePanelClick, postId}) => {
    const [copied, setCopied] = useState(false);

    const shortcode = `[wppfetfe_testimonials post_id="${postId ?? ''}"]`;

    const handleCopyToClipboard = () => {
        navigator.clipboard.writeText(shortcode).then(() => {
            setCopied(true);
            setTimeout(() => setCopied(false), 2000); // Reset the copied state after 2 seconds
        });
    };

    return (
        <PanelBody
            initialOpen={false}
            title={__('Shortcode', 'testimonials-for-everyone')}
            onToggle={() => handlePanelClick('shortcode')}
            style={{
                borderBottom: activeTab === 'spacings' ? '2px solid #007cba' : 'none',
            }}
        >
            <div className="shortcode-panel">
                <div className="shortcode-wrapper">
                    <br/>
                    <code>{shortcode}</code>
                    <br/><br/>
                    <p>{__('Copy and paste this shortcode to display the testimonials for this post.', 'testimonials-for-everyone')}</p>

                    <button style={{width:'100%'}} onClick={handleCopyToClipboard}>
                        {copied ? 'Copied!' : 'Copy'}
                    </button>
                </div>
            </div>
        </PanelBody>
    );
};

export default ShortcodePanel;
